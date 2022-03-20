#include <stdio.h> //printf scanf
#include <fcntl.h> //pour fopen
#include <unistd.h>
#include  <stdlib.h>
#include <string.h>

#define TESTEOF(i) if (i==EOF){\
    printf("erreur lecture/ecriture fichier");}

//#define __BUG__
#ifdef __BUG__
#define DEBUG(msg) msg
#else
#define DEBUG(msg)
#endif

//Permet de reconstituer le tableau code qui permet d'associer un caractere en ascii a son code binaire 
void rentreCode(FILE* fr,int nbcode,char *code[256])
{
	int j, c,inter,cpt;
	// j : Stocke le code Ascii
	// c : Stocke la valeur decimal du code binaire
	// inter : Permet de recuperer 'c' si la valeur decimal est sup a 255
	// cpt : Stocke la longueur du code binaire
	for (int i=0;i<256;i++)
	{
		code[i]=NULL;
	}
	
	for (int i=0;i<nbcode;i++)
	{
		j=fgetc(fr);      //On recupere le code ASCII du caractere
		cpt=fgetc(fr);      //On recupere la longueur du code binaire du caractere
		code[j]=malloc(cpt*sizeof(char));   //On créer une zone allouée dynamiquement lors de la compression qui va contenir le code binaire
		inter=fgetc(fr);                       //On recupere la valeur decimal
		c=inter;
		
		while (inter==255)
		{
			inter=fgetc(fr);
			c+=inter;
		}
		DEBUG(printf("total %d ",c);)
		//Boucle pour reconstituer le code binaire dans le tableau
		for (int i=cpt-1;i>=0;i--)
		{
			code[j][i]=c%2+48;         //On rentre le code Ascii du caractere et le tableau le converti en binaire
			c/=2;
			//printf("code[j][i] : %d (%c)\n",code[j][i],code[j][i]);
		}
		//DEBUG(printf("car : '%c' %d\tlen %ld %s \n",j,j,strlen(code[j]), code[j]);)
	}
}


void intToBin(int c, char buffer[16],int cpt)
{
	for (int i=7;i>=0;i--)
	{
		buffer[cpt]=c%2+48;
		cpt++;
		c/=2;
	}
}

int trouveCode(char buffer[64],int *cpt,int *cptb, char*code[256])
{
	int i=0,j,trouver=-1,eg,compt=0;
	// i : Code ASCII du caractere, permet de nous deplacer dans le tableau 'code'
	// j : Permet de nous déplacer dans le code binaire (sa longueur) d'un caractere
	// trouver : Permet de savoir si on a trouvé le caractere coresspondant au code binaire et lequel
	// eg : Permet de savoir si code[i][j] et buffer[j] sont egaux. O si non, 1 si oui
	// compt : Compteur de la longueur du code binaire
	while (i<256 && trouver==-1)
	{
		j=0;eg=1;compt=0;
		if (code[i]!=NULL)
		{
			DEBUG(printf("i debut = %d \n",i);)
			//Permet de tester si le caractere correspond au code binaire jusqu'au bout
			while (eg && j<(*cpt) && code[i][j]!='\0')
			{
				DEBUG(printf("compt = %d \n",compt);)
				compt++;
				if (code[i][j]!=buffer[j])
				{ 
					DEBUG(printf("code[i][j] = %d \n",code[i][j]);)
					DEBUG(printf("buffer[j] = %d \n",buffer[j]);)
					eg=0;
				}
				j++;
			}
			//Si je suis bien a la fin du code binaire avec une egalité, on a trouvé le bon code
			if (code[i][j]=='\0' && eg)
			{
				trouver=i;
				DEBUG(printf("trouver fin = %d \n",trouver);)
				for (i=0;i<(*cpt)-compt;i++) 
				{
					DEBUG(printf("i for = %d \n",i);)
					DEBUG(printf("buffer[i] = %d \n",buffer[i]);)
					buffer[i]=buffer[i+compt];
				}
			}
			else
				compt=0;
			}
			i++;	 
	}
	*cpt=*cpt-compt;
	*cptb=*cptb+compt;
	return trouver;
}

void decomp (FILE* fr, FILE*fw, int nbb, char* code[256])
{
	int c,r,cpt=0,cptb=0;char buffer[64];
	// cptb : Compteur du nbr de bits
	//c=fgetc(fr);//pour le \n
	//printf("caractère rentré : ");
	while (cptb<nbb)
	{
		c=fgetc(fr);
		TESTEOF(c);
		intToBin(c,buffer,cpt);
		DEBUG(printf("c = %d \n",c);)
		//DEBUG(printf("buffer = %c \n",buffer);)
		DEBUG(printf("cpt = %d \n",cpt);)
		cpt+=8;
		c=0;
		while ((c!=-1) && cpt>0 && cptb<nbb)
		{
			c=trouveCode(buffer,&cpt,&cptb,code);
			if(c!=-1)
			{
				r=fputc(c,fw);
				TESTEOF(r);
				//printf("%c",c);
			}
		}
	}
	//printf("\n");
}

  
int main(int argc, char** argv)
{
	if(argc!=3)
	{
		printf("erreur 2 arguments attendu\n");
		return 1;
	}
	FILE* fr=fopen(argv[1],"r");
	FILE* fw=fopen(argv[2],"w");
	DEBUG(printf("fichier ouvert\n");)
	//On recupere le nombre de bit
	int get=fgetc(fr),nbb=get;
	//Tant qu'il (le code askii) sera = a 255, c'est qu'il y a un autre caractere à ajouter
	while (get==255)
	{
		get=fgetc(fr);
		nbb+=get;
	}
	//On recupere le nombre de code
	int nbcode=fgetc(fr);
	DEBUG(printf("nbcode : %d\n",nbcode);)
	char *code[256];
	//Reconstitue le code binaire
	rentreCode(fr,nbcode,code);
	DEBUG(printf("code rentré\n");)
	//On reécrit le fichier final
	decomp(fr,fw,nbb,code);
	DEBUG(printf("decompression termine\n");)
	nbb=fclose(fr);
	nbb=fclose(fw);
  
  return 0;
}
