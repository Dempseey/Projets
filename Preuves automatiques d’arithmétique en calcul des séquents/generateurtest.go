package main

import (
	"fmt"
  "math/rand"
  "time"
  "math/big"
)

// Returns an int >= min, < max
func randomInt(min, max int) int {
return min + rand.Intn(max-min)
}

func generateurtest (x int)(){

  rand.Seed(time.Now().UnixNano())
  
  if x == 17 {

    var varalea1 int64 = int64(randomInt(-10, 11))
    var varalea2 int64 = int64(randomInt(-10, 11))
    var varalea3 int64 = int64(randomInt(-10, 11))
    var varalea4 int64 = int64(randomInt(-10, 11))
    var varalea5 int64 = int64(randomInt(-10, 11))
    var varalea6 int64 = int64(randomInt(-10, 11))
    
    var tab_var = make([]string,0)	
	var incremental_coef = make([]*big.Rat, 0)
	var incremental_aff= make([]*big.Rat,0)
    var tableau = [][]*big.Rat{{big.NewRat(varalea1,1),big.NewRat(varalea2,1)}, {big.NewRat(varalea3,1),big.NewRat(varalea4,1)}}
    var tab_cont = []*big.Rat{big.NewRat(varalea5,1),big.NewRat(varalea6,1)}
    //creation tableau des affectations : taille = nombre de ligne + nombre de colonnes
	alpha_tab := create_alpha_tab(tableau, tab_var)
	//tableau qui nous donne la postion des variables dans le tableau alpha_tab
	var pos_var_tab = create_pos_var_tab(tableau, tab_var)
	var bland = make([]string, len(pos_var_tab))
	fmt.Println("\033[0m") 

	for i:=0;i<len(tableau);i++ {
		bland[i+len(tableau[0])]=pos_var_tab[i]
	}
	
	for i:=0;i<len(tableau[0]);i++{
		bland[i]=pos_var_tab[i+len(tableau)]
	}
	
	var PosConst = make([]int, len(tab_cont))
	for i := 0; i<len(tab_cont);i++{
		PosConst[i]=i
	}



    system := info_system{tab_coef: tableau, tab_cont: tab_cont, tab_nom_var: tab_var,
			pos_var_tab: pos_var_tab, bland: bland, alpha_tab: alpha_tab,
			incremental_coef: incremental_coef, incremental_aff: incremental_aff}
		Simplexe(system)
  }

  if x == 18{
    var varalea1 int64 = int64(randomInt(-10, 11))
    var varalea2 int64 = int64(randomInt(-10, 11))
    var varalea3 int64 = int64(randomInt(-10, 11))
    var varalea4 int64 = int64(randomInt(-10, 11))
    var varalea5 int64 = int64(randomInt(-10, 11))
    var varalea6 int64 = int64(randomInt(-10, 11))
    var varalea7 int64 = int64(randomInt(-10, 11))
    var varalea8 int64 = int64(randomInt(-10, 11))
    var varalea9 int64 = int64(randomInt(-10, 11))
    
    
    var tab_var = make([]string,0)	
	var incremental_coef = make([]*big.Rat, 0)
	var incremental_aff= make([]*big.Rat,0)
    var tableau = [][]*big.Rat{{big.NewRat(varalea1,1),big.NewRat(varalea2,1)}, {big.NewRat(varalea3,1),big.NewRat(varalea4,1)},{big.NewRat(varalea5,1),big.NewRat(varalea6,1)}}
    var tab_cont = []*big.Rat{big.NewRat(varalea7,1),big.NewRat(varalea8,1),big.NewRat(varalea9,1)}
    //creation tableau des affectations : taille = nombre de ligne + nombre de colonnes
	alpha_tab := create_alpha_tab(tableau, tab_var)
	//tableau qui nous donne la postion des variables dans le tableau alpha_tab
	var pos_var_tab = create_pos_var_tab(tableau, tab_var)
	var bland = make([]string, len(pos_var_tab))
	fmt.Println("\033[0m") 

	for i:=0;i<len(tableau);i++ {
		bland[i+len(tableau[0])]=pos_var_tab[i]
	}
	
	for i:=0;i<len(tableau[0]);i++{
		bland[i]=pos_var_tab[i+len(tableau)]
	}
	
	var PosConst = make([]int, len(tab_cont))
	for i := 0; i<len(tab_cont);i++{
		PosConst[i]=i
	}



    system := info_system{tab_coef: tableau, tab_cont: tab_cont, tab_nom_var: tab_var,
			pos_var_tab: pos_var_tab, bland: bland, alpha_tab: alpha_tab,
			incremental_coef: incremental_coef, incremental_aff: incremental_aff}
		Simplexe(system)
    
  }

  if x == 19{

    var varalea1 int64 = int64(randomInt(-10, 11))
    var varalea2 int64 = int64(randomInt(-10, 11))
    var varalea3 int64 = int64(randomInt(-10, 11))
    var varalea4 int64 = int64(randomInt(-10, 11))
    var varalea5 int64 = int64(randomInt(-10, 11))
    var varalea6 int64 = int64(randomInt(-10, 11))
    var varalea7 int64 = int64(randomInt(-10, 11))
    var varalea8 int64 = int64(randomInt(-10, 11))
    var varalea9 int64 = int64(randomInt(-10, 11))
    var varalea10 int64 = int64(randomInt(-10, 11))
    var varalea11 int64 = int64(randomInt(-10, 11))
    var varalea12 int64 = int64(randomInt(-10, 11))
    
    
    var tab_var = make([]string,0)	
	var incremental_coef = make([]*big.Rat, 0)
	var incremental_aff= make([]*big.Rat,0)
    var tableau = [][]*big.Rat{{big.NewRat(varalea1,1),big.NewRat(varalea2,1),big.NewRat(varalea3,1)}, {big.NewRat(varalea4,1),big.NewRat(varalea5,1),big.NewRat(varalea6,1)},{big.NewRat(varalea7,1),big.NewRat(varalea8,1),big.NewRat(varalea9,1)}}
    var tab_cont = []*big.Rat{big.NewRat(varalea10,1),big.NewRat(varalea11,1),big.NewRat(varalea12,1)}
    //creation tableau des affectations : taille = nombre de ligne + nombre de colonnes
	alpha_tab := create_alpha_tab(tableau, tab_var)
	//tableau qui nous donne la postion des variables dans le tableau alpha_tab
	var pos_var_tab = create_pos_var_tab(tableau, tab_var)
	var bland = make([]string, len(pos_var_tab))
	fmt.Println("\033[0m") 

	for i:=0;i<len(tableau);i++ {
		bland[i+len(tableau[0])]=pos_var_tab[i]
	}
	
	for i:=0;i<len(tableau[0]);i++{
		bland[i]=pos_var_tab[i+len(tableau)]
	}
	
	var PosConst = make([]int, len(tab_cont))
	for i := 0; i<len(tab_cont);i++{
		PosConst[i]=i
	}



    system := info_system{tab_coef: tableau, tab_cont: tab_cont, tab_nom_var: tab_var,
			pos_var_tab: pos_var_tab, bland: bland, alpha_tab: alpha_tab,
			incremental_coef: incremental_coef, incremental_aff: incremental_aff}
		Simplexe(system)
    
  }
}