package ari

import (
	"math/big"
	"fmt"
)

func create_alpha_tab(tab_coef [][]*big.Rat, tab_nom_var []string) map[string]*big.Rat{
	alpha_tab := make(map[string]*big.Rat)
	//Creation variable d'ecart
	for i := 0; i < len(tab_coef); i++ {
		alpha_tab[fmt.Sprint("e", i)] = new(big.Rat)
	}
	//Creation variable initial
	if len(tab_nom_var) == 0 {
	    for i := 0; i < len(tab_coef[0]); i++ {
		alpha_tab[fmt.Sprint("x", i)] = new(big.Rat)
	    }
    } else {
        for i := 0; i < len(tab_coef[0]); i++ {
            alpha_tab[tab_nom_var[i]] = new(big.Rat)
	    }
    }
	return alpha_tab
}


func create_pos_var_tab(tab_coef [][]*big.Rat, tab_nom_var[]string) []string{
	//len(tab_coef[0]) correspond au nombre de ligne soit au nombre de variable d'ecart
	//len(tab_coef) correspond au nombre de colonne soit au nombre de variable initial
	var pos_var_tab = make([]string, len(tab_coef[0])+len(tab_coef))
	taille_tab := len(tab_coef)
	for i := 0; i < taille_tab + len(tab_coef[0]); i++ {
		if i < taille_tab {
			pos_var_tab[i] = fmt.Sprint("e", i)
		} else {
		    if len(tab_nom_var) == 0 {
		        pos_var_tab[i] = fmt.Sprint("x", i-taille_tab)
		    } else {
		        pos_var_tab[i] = tab_nom_var[i-taille_tab]
		    }
		}
	}
	
	return pos_var_tab
}

func bland(pos_var_tab []string, tableau [][]*big.Rat, tab_var []string) []string{

	var bland = make([]string, len(pos_var_tab))
	fmt.Println("\033[0m") 

	for i:=0;i<len(tableau);i++ {
		bland[i+len(tableau[0])]=pos_var_tab[i]
	}
	
	for i:=0;i<len(tableau[0]);i++{
		bland[i]=pos_var_tab[i+len(tableau)]
	}
	return bland
}

	