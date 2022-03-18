SET SERVEROUTPUT ON;

prompt
prompt =====================================================
prompt Bienvenue dans le programme BDD Squid Game (Groupe 3)
prompt =====================================================
prompt
prompt Assurez-vous d"avoir execute les fichiers "suppression_Groupe3.sql" puis "creation_Groupe3.sql" avant de continuer! Ouvrez egalement la console en grand!
prompt
prompt En raison d"obligations techniques liees au langage
prompt Merci renseigner TOUS les inputs pour les 2 fonctions a tester (se referer a la doc du rapport pour la signification des parametres)
prompt
prompt Fonction nbrAmisVivants: 1 input
prompt Precedure emettrePari: 4 inputs
prompt
prompt ====================================================================
prompt
prompt


-- SCRIPT DE LANCEMENT DES TESTS

DECLARE

	--variables locales
	
	num_joueur PERSONNE.NUMERO%TYPE;
	nbr_amis_vivants NUMERIC(3, 0);
	
	num_investisseur INVESTISSEUR.NUM_INV%TYPE;
	num_joueur_2 PERSONNE.NUMERO%TYPE;
	nom_jeu JEUX.NOM%TYPE;
	somme PARI.SOMME%TYPE; 
	
BEGIN

	DBMS_OUTPUT.ENABLE();


	--input pour la fonction nbrAmisVivants
	
	num_joueur := &NUM_JOUEUR_FONCTION_NBRAMISVIVANTS;
	
	
	--input pour la procedure emettrePari
	
	num_investisseur := &NUM_INVESTISSEUR_FONCTION_EMETTREPARI;
	num_joueur_2 := &NUM_JOUEUR_FONCTION_EMETTREPARI;
	nom_jeu := &NOM_JEU_FONCTION_EMETTREPARI;
	somme := &SOMME_FONCTION_EMETTREPARI;
	
	
	DBMS_OUTPUT.put_line(chr(10) || chr(10));
	
	
	-- lancement des fonctions/procedures
	
	nbr_amis_vivants := nbrAmisVivants(num_joueur);
	
	DBMS_OUTPUT.put_line('==================================================================');
	DBMS_OUTPUT.put_line('RESULTAT Fonction nbrAmisVivants: Le joueur ' || num_joueur || ' a : ' || nbr_amis_vivants || ' amis vivants!');
	DBMS_OUTPUT.put_line('==================================================================');
	
	DBMS_OUTPUT.put_line(chr(10));
	
	emettrePari(num_investisseur, num_joueur_2, nom_jeu, somme);
	
	DBMS_OUTPUT.put_line('==================================================================');
	DBMS_OUTPUT.put_line('RESULTAT Fonction emettrePari: Si vous lisez ce message c''est que l''insertion du pari s''est bien effectuee!');
	DBMS_OUTPUT.put_line('==================================================================');
	
	DBMS_OUTPUT.put_line(chr(10));
	
END;
/

prompt ==================================================================
prompt REQUETES TESTS:
prompt ==================================================================
prompt

prompt	
prompt
prompt
prompt Nombre de pari sur les jeux passés ou en cours :
SELECT COUNT(NUM_JOUEUR) AS Nombre_paris, NOM_JEU FROM PARI GROUP BY NOM_JEU;

prompt	
prompt
prompt
prompt Joueurs dont le nom de famille commence par la lettre A :
SELECT PRENOM,NOM,NUMERO FROM PERSONNE WHERE NOM LIKE 'A%';

prompt	
prompt
prompt	
prompt Gardes qui ont supervisés le deuxième jeu :
SELECT PRENOM,NOM,NUMERO,SYMBOLE FROM PERSONNE 
WHERE NUMERO in (SELECT NUM_GARDE FROM SUPERVISE WHERE NOM_JEU = 'BISCUIT');

prompt	
prompt	
prompt	
prompt Pseudo de la personne qui a parier la plus grande somme :
SELECT PSEUDO FROM INVESTISSEUR WHERE NUM_INV =(
	SELECT NUM_INV FROM PARI WHERE SOMME >= (
		SELECT MAX(SOMME) FROM PARI));

prompt	
prompt	
prompt	
prompt Joueurs vivants sur lesquels personnes n a parié :
SELECT PRENOM, NOM, NUMERO FROM PERSONNE WHERE NOT EXISTS (
	SELECT NUMERO FROM PARI WHERE NUMERO = NUM_JOUEUR)
AND VIVANT = '1';	

prompt

prompt =======================================================
prompt Fin du script
prompt Relancez le pour essayer avec d"autres valeurs
prompt =======================================================
prompt
