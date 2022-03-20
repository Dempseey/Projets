#include <stdlib.h>
#include <string.h>
#include <stdio.h> //printf scanf
#include <fcntl.h> //pour fopen
#include <unistd.h>

//#define __BUG__
#define TESTEOF(i) if (i==EOF){\
    printf("erreur ecriture fichier");}
#ifdef __BUG__
#define DEBUG(msg) msg
#else
#define DEBUG(msg)
#endif

typedef struct noeud
{
	unsigned int nbOcc; //Nombre d'occurence du caractère
	int gauche;
	int droit;
	int parent;         //Indice du parent 
	char c;             //Char représenté (trouvé dans le fichier) 
} noeud;

typedef struct arbre
{
	noeud* tableau; //Pointeur (tableau de) noeud
	int tailleArbre;
} arbre;
/** 
 * Construit un arbre de Huffman a partir d'un fichier
 * @param chemin nom du fichier
 * @return retourne un arbre de Huffman
 */
arbre *arbreCreer(char* chemin)
{
	DEBUG(printf("==> Fct arbreCreer \n");) 
	// Déclaration des variables 
	int nbOccTab[256]={0};
	int nbChar=0;
	int nbFeuille=0;
	int c;

	FILE* f = fopen(chemin,"r"); //Ouverture du fichier
	if(f==NULL)
	{
		fprintf(stderr,"impossible d'ouvrir le fichier\n");
		exit(1);
	}
	
	//c : le caractère du fichier mais sous forme de code ASCII (0 à 255)
	while((c=fgetc(f))!=EOF)
	{
		nbChar++;
		if(nbOccTab[c]==0)		//Vrai si trouve première fois
		{
			nbFeuille++;  	//Nombre de Feuilles = nombre de caractères au sens ASCII
		}
		nbOccTab[c]++;
	}
	for(int i=0; i<256; i++)
	{
		if(nbOccTab[i]!=0)
		{
			printf("Dans le fichier, on a le caractere '%c' et sa probabilité d'apparition est de %.2f \n",i,(float)nbOccTab[i]/nbChar);
		}
	}
	// printf("nbChar = %d\n",nbChar);
	printf("La taille du fichier est de %d octets \n",nbChar);
	
	
	arbre* a=malloc(sizeof (arbre)); // à la compil, on attribuera 1 tableau dynamique
	a->tailleArbre=nbFeuille*2-1;
	a->tableau=malloc(sizeof (noeud)*a->tailleArbre);
	
	int it=0; //Indice dans le tableau
	// boucle pour alimenter les variables de la structure dynamique arbre, à partir du tableau des occurences
	for(int i=0; i<256; i++)
	{
		if(nbOccTab[i]!=0)
		{
			a->tableau[it].c=i; // C'est le caractere que l'on parcours, donc arbre est ordonnée par rapport aux codes ASCII
			a->tableau[it].nbOcc=nbOccTab[i]; //Nombre d'occurences
			a->tableau[it].droit=a->tableau[it].gauche=a->tableau[it].parent=-1; 
			it++;
		}
	}
	
	// Boucle pour calculer les noeuds intermédiares. Règles : 1 noeud intermédiaire = les 2 feuilles avec le moins d'occurences 	
	for(int nn=it; nn<a->tailleArbre; nn++)
	{
		//Choix des 2 plus petits noeuds orphelin (ceux qui ont le moins de nbOcc)
		int min1 = nbChar,imin1;
		int min2 = nbChar,imin2;
		
		for(int i=0; i<nn; i++)
		{	
			//Si parent = -1 et que le nbr d'occurence du tableau est plus petit que l'actuel minimum
			if(a->tableau[i].parent==-1 && a->tableau[i].nbOcc<min1)
			{
				min2=min1; //L'ancien plus petit (min1) devient min2
				imin2=imin1;

				min1=a->tableau[i].nbOcc; //min1 prend la valeur de l'occurence du tableau 
				imin1=i; //L'indice de min1 prend la valeur de l'indice du tableau ou se trouve le nbr d'occurence (min1)
			}
			//Si parent = -1 et que le nbr d'occurence du tableau est plus petit que le 2eme minimum (min2)
			else if(a->tableau[i].parent==-1 && a->tableau[i].nbOcc<min2)
			{	
				min2=a->tableau[i].nbOcc; //min2 prend la valeur de l'occurence du tableau 
				imin2=i;
			}
			
		} //On a trouvé les deux plus petits orphelins
		
		a->tableau[nn].gauche=imin1;
		a->tableau[nn].droit=imin2;
		a->tableau[nn].nbOcc=min1+min2;
		a->tableau[nn].parent=-1;
		a->tableau[nn].c='i'; //"i" pour noeud interne
		a->tableau[imin1].parent=nn;
		a->tableau[imin2].parent=nn;
		
		DEBUG(printf("Noeud intermediare en position %d, a sa gauche : '%c' , a sa droite : '%c' \n",nn,a->tableau[imin1].c,a->tableau[imin2].c);)
		
	}
	
	fclose(f); // fermeture du fichier
	return a; //on retourne l'arbre	
}

void arbreAfficherCodes(arbre* a)
{
	DEBUG(printf("==> Fct arbreAfficherCodes \n");)
	// boucle à partir de la Racine, donc on décrémente
	printf("\nAffichage de l'arbre en commençant par la Racine \n");
        for(int i=(a->tailleArbre-1); i>=0; i--)
        {
			if(i==(a->tailleArbre-1))
			{
				printf("Racine (%d), composée des cellules : %d (gauche), à %d (droite) \n",i,a->tableau[i].gauche,a->tableau[i].droit);
			}
			else
			{
				if (a->tableau[i].gauche==-1 && a->tableau[i].droit==-1)
				{
					printf("Cellule %d,  contient la feuille  : '%c, nombre Occ : %d' \n",i,a->tableau[i].c,a->tableau[i].nbOcc);
				}
				else
				{
					printf("Cellule %d,  composée des cellules : %d (gauche), à %d (droite) \n",i,a->tableau[i].gauche,a->tableau[i].droit); 
				}
			}
        }
        printf("\n");
}

// Creation du tableau "code" qui va contenir les "0" et les "1"
void CreerCode(int i,arbre* a,char* code[256],int ic, char* codeActu)
{
	DEBUG(printf("==> Fct CreerCode \n");)
	DEBUG(printf("On est à la position %d dans arbre \n",i);)
	// On regarde si on tombe sur une feuille
	if (a->tableau[i].gauche==-1 && a->tableau[i].droit==-1)
	{
		DEBUG(printf("Pour la feuille '%c' \n",a->tableau[i].c);)
		int ind = (int)a->tableau[i].c;
		code[ind]=(char*)malloc((ic+1));
		//printf("On initialise code[i] avec ic: %d \n",ic);

		for(int j=0;j<ic;j++)
		{
			code[ind][j]=codeActu[j]; //On associe le code à son caractere 
			//printf("On affiche j: %d et i: %d \n",j,i);
		}
		
		code[ind][ic]='\0';
		printf("le code pour le caractere '%c' est : %s \n",a->tableau[i].c,code[ind]);
	}
	
	else
	{	
		DEBUG(printf("On est dans un noeud intermédiaire %d, fils gauche : %d, fils droit : %d \n",i, a->tableau[i].gauche, a->tableau[i].droit);)
		
		//Si il y a un fils gauche
		if (a->tableau[i].gauche!=-1)
		{
			DEBUG(printf("On va dans %d (fils gauche) \n",a->tableau[i].gauche);)
			DEBUG(printf("on ajoute un '0' dans codeActu, à l'indice : %d \n",ic);)
			codeActu[ic]='0';
			ic++; //On rappel la fonction en descendant d'un etage de l'arbre
			CreerCode(a->tableau[i].gauche,a,code,ic,codeActu);
		}
		
		//Si il y a un fils droit
		if (a->tableau[i].droit!=-1)
		{
			DEBUG(printf("On va dans %d (fils droit) \n",a->tableau[i].droit);)
			DEBUG(printf("codeACtu : on ajoute un '1' à l'indice ic: %d \n",ic);)
			codeActu[ic-1]='1'; 
			//On rappel la fonction 
			CreerCode(a->tableau[i].droit,a,code,ic,codeActu);
		}
	}
	DEBUG(printf("Fin du traitement pour la position %d de l'arbre \n",i);)
}

// fonction pour convertir 1 octet en caractere ASCII 
int convertirAscii(int  oct[8])
{
  DEBUG(printf("==> Fct convertirAscii \n");)
  int s=0,mul=1;
  DEBUG(printf("oct : ");)
  for (int i=0;i<8;i++)
  {
    DEBUG(printf("%d",oct[i]);)
    s+=oct[i]*mul;
    mul*=2;
  }
  DEBUG(printf("\n");)
  return s;
}

//On ajoute dans le fichier compressé, les caracteres du fichier source mais en binaire (utilisation du code Huffman)
void ajoutHuff(char* fichier,FILE* fw, char* code[256])
{
   DEBUG(printf("==> Fct ajoutHuff \n");) 
   FILE* fr=fopen(fichier,"r");
  
	int i, nbr=0, cpt=0, c, buff[200], oct[8];
	// nbr : Nombre de , initialise à 0
	// cpt : Nombre de , initialise à 0 
	// c : Stocke l
	// buff : Tableau
	// oct :Tableau
  
	//On lit les caracteres un par un
	while ((i=fgetc(fr))!=EOF)
	{
		DEBUG(printf("i : %d \n",i);)
		for (int j=0; j<strlen(code[i]);j++)
		{
			DEBUG(printf("le caractere i est composé de: %d \n",code[i][j]-48);)
			buff[cpt]=code[i][j]-48;//-48 pour correspondre au nombre '1' -> 1
			cpt++;
			nbr++;
		}
		if (cpt>=8)
		{
			//si on a plus de 8 caractere -> transfere fichier
			for (int j=0;j<8;j++)
			{
				oct[j]=buff[j];
			}
			for (int j=0;j<cpt-8;j++)
			{ 
				//on décalde tous les 0 et 1 qui ne vont pas être transferer
				buff[j]=buff[j+8];
			}
			cpt-=8;
			DEBUG(printf("buff : ");)
		 
			for (int j=0;j<cpt;j++)
			{
				DEBUG(printf("%d",buff[j]);)
			}
		 
			DEBUG(printf("\n");)
			c=convertirAscii(oct);
			i=fputc(c,fw);
			TESTEOF(i);
			DEBUG(printf("caractère rentrer dans le fichier : %c de valeur : %d\n",c,c);)
		}
	}
	for (int j=0;j<cpt;j++)
	{
		oct[j]=buff[j];
	}
	for (int j=cpt;j<8;j++)
	{
		oct[j]=0;
	}
	c=convertirAscii(oct);
	i=fputc(c,fw);
	TESTEOF(i);
	DEBUG(printf("caractère rentrer dans le fichier : %c de valeur : %d\n",c,c);)
	i=fclose(fr);
}

int convertirN(char* code, int t)
{
	//Sert à convertir le code binaire en decimal
	DEBUG(printf("==> Fct convertirN \n");)
	int mul=1, r=0;
	for (int i=t-1;i>=0;i--)
	{
		r+=mul*(code[i]-48); //-48 pour correspondre au nombre '1' -> 1
		mul*=2;
	}
	return r;
}

int ReturnNbBit(arbre* a,char* code[256],int i,int* nbcode) 
{
	DEBUG(printf("==> Fct ReturnNbBit \n");)
	if (a->tableau[i].gauche==-1 && a->tableau[i].droit==-1)
	{
		//On cherche le nbr de bits dans le tableau code 
		//Compte le nbr de feuilles pour avoir le nbr de code
		*nbcode=*nbcode+1;
		
		return strlen(code[(int)a->tableau[i].c])*a->tableau[i].nbOcc; //Compte la longueur de bits a partir du tableau code * l'occurence du caractere
	} 
	else
	{	//Recurssif sur le fils gauche puis le fils droit
		return ReturnNbBit(a,code,a->tableau[i].gauche,nbcode)+ReturnNbBit(a,code,a->tableau[i].droit,nbcode);
	}
}

	

void ajoutcode(FILE* fw, char *code[256], arbre* a)
{
	DEBUG(printf("==> Fct ajoutcode \n");)
	// r   : Permet de stocker sous forme decimal la valeur du code binaire
	// nbb : Nombre de bits, initialise à 0
	// nbcode : Nombre de code (caractere) distinct, initialise à 0 
	// res : Stocke le caractere dont la valeur askii est 255
	int r,nbb=0,nbcode=0,res; //nbb =nombre bit
  
	//Pour l'ajout du nombre de bit et de code
	nbb=ReturnNbBit(a,code,a->tailleArbre-1,&nbcode);
	DEBUG(printf("Nombre de Bits : %d\n",nbb);)
  
	DEBUG(printf("nbb %d\n",nbb);)
  
	//On ecrit le nbr de bits total dans le fichier par paquet de 256 caracteres
	while (nbb>=255)
	{
		r=fputc(255,fw);   
		nbb-=255;
	}
  
	r=fputc(nbb,fw);
	DEBUG(printf("r = %d \n",r);)
  
	//On ecrit le nbr de code dans le fichier
	DEBUG(printf("nbcode %d\n",nbcode);)
	r=fputc(nbcode,fw);
	DEBUG(printf("r = %d \n",r);)

	//On ajoute tous les code au format caractère suivit du code 
	for (int i=0;i<256;i++)
	{
		if (code[i]!=(NULL))
		{
			DEBUG(printf("car : '%c' %d\t",i,i);)
			//On rentre l'indice du code (la valeur ascii du caractere) dans le fichier
			r=fputc(i,fw);
      
			DEBUG(printf("len %d %s",strlen(code[i]),code[i]);)
			//On rentre la longueur du code binaire du caractere dans le fichier
			r=fputc(strlen(code[i]),fw);
      
			//On converti les bits en int
			r=convertirN(code[i],strlen(code[i]));
			DEBUG(printf("\t\t D %d \t C ",r);) //D:Décimal C:Le reste de la division par 255
      
			//On rentre cette valeure decimal par paquet de 256
			while (r>=255)
			{
				res=fputc(255,fw);
				//DEBUG(printf("%d|",res);)
				r-=255;
			}
			//On ajoute le reste de la division par 255 dans le fichier
			r=fputc(r,fw);
			DEBUG(printf("%d\n",r);)
    
		}
	}
}

int main(int argc, char** argv)
{
	int nbCode = 0;
	int longueurTot = 0;
	int sizeComp;      // taille du fichier compresse
	int sizeOriginale; // taille du fichier original (est le nbre d'occurence de la Racine)

	DEBUG(printf("==> Programme Principal \n");) 	
	if(argc!=3)
	{
		fprintf(stderr,"J'ai besoin de 2 arguments svp\n");
		exit(2);
	}
	
	arbre* a=arbreCreer(argv[1]);
	arbreAfficherCodes(a);  //Affichage des codes de chaques caracteres
	char* code[256];	        // code est le tableau qui va associer les caractères à leur codage Huffman
	for (int i=0; i<256; i++)
	{
		code[i]=NULL;
	}
	char codeActu[256];     // tableau intermediaire et indépendant de 256 caractères pour stocker le code de Huffman sous forme de '0' et de '1'
	CreerCode(a->tailleArbre-1,a,code,0,codeActu);	// Création du tableau des codes sous forme de '0' et de '1'
	
	//Boucle pour afficher la longueur moyenne de codage
		for(int i=0;i<256;i++)
		{
			if(code[i]!=0)
			{
				nbCode=nbCode+1;
				longueurTot=longueurTot+strlen(code[i]);		
			}
		}
		printf("La longueur moyenne de codage est de %.2f bits \n",(float)longueurTot/nbCode);
		
	char* linkfw=argv[2];       //Le fichier compressé est le 2eme argument à l'appel de la fonction
	
	FILE* fw=fopen(linkfw,"w");
	//On créer le fichier compressé 
    ajoutcode(fw,code,a);         
    ajoutHuff(argv[1],fw,code);
    
    //Calcul du gain de la compression

	//Calcul taille du fichier origine : c'est la somme des occurences qui est dans le nbOcc de la Racine !
	sizeOriginale=a->tableau[a->tailleArbre-1].nbOcc ;
	printf("La taille du fichier origine  '%s' est de: %d octets \n", argv[1], sizeOriginale);

	//Calcul taille du fichier compressé
    sizeComp = (double)ftell(fw);
    printf("La taille du fichier compressé '%s' est de: %d octets \n", argv[2], sizeComp);

	//On affiche le gain
	printf("Taille originelle : %d; taille compressée : %d; gain : %6.2f %% ! \n",sizeOriginale,sizeComp,(1-(float)sizeComp/sizeOriginale)*100);

	//On ferme le fichier compressé
    fclose(fw);
    
}

