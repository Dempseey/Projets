/*
Requetes SQL
*/

prompt ------------------------------------------;
prompt -------    Création REQUETES    ----------;
prompt ------------------------------------------;


/*
1.	Nombre de pari sur les jeux passés ou en cours
*/


prompt ---------------------------------------------;
prompt Nombre de pari sur les jeux passé ou en cours;
prompt ---------------------------------------------;


SELECT COUNT(NUM_JOUEUR),NOM_JEU FROM PARI GROUP BY NOM_JEU;


/*
2.	Joueurs dont le nom de famille commence par la lettre A
*/


prompt -------------------------------------------------------;
prompt Joueurs dont le nom de famille commence par la lettre A;
prompt -------------------------------------------------------;



SELECT PRENOM,NOM,NUMERO FROM PERSONNE WHERE NOM LIKE 'A%';


/*
3.	Gardes qui ont supervisés le deuxième jeu
*/


prompt -----------------------------------------;
prompt Gardes qui ont supervisés le deuxième jeu;
prompt -----------------------------------------;


SELECT PRENOM,NOM,NUMERO,SYMBOLE FROM PERSONNE WHERE NUMERO in (SELECT NUM_GARDE FROM SUPERVISE WHERE NOM_JEU = 'BISCUIT');



/*
4.	Pseudo de la personne qui a parié la plus grande somme
*/


prompt -------------------------------------------------------;
prompt Pseudo de la personne qui a parier la plus grande somme;
prompt -------------------------------------------------------;


SELECT PSEUDO FROM INVESTISSEUR WHERE NUM_INV =(
	SELECT NUM_INV FROM PARI WHERE SOMME >= (
		SELECT MAX(SOMME) FROM PARI));


/*
5. Joueurs vivants sur lesquels personnes n a parié
*/


prompt -------------------------------------------------------;
prompt Joueurs vivants sur lesquels personnes n a parié ;
prompt -------------------------------------------------------;


SELECT PRENOM, NOM, NUMERO FROM PERSONNE WHERE NOT EXISTS (
	SELECT NUMERO FROM PARI WHERE NUMERO = NUM_JOUEUR)
	AND VIVANT = '1';


