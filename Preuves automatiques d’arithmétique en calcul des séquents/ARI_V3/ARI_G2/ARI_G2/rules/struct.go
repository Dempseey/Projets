package ari

import "math/big"

/*
`tab_coef`, the matrice with the normalized inequations
`tab_cont`, an array containing the constraints, tab_cont[0] contains the constraint of the first line of the matrice
`tab_nom_var`, an array of the system's starting variable
`pos_var_tab`, an array containing the variable positions in the matrice starting by the out-base variable
`bland`, an array containing the Bland order of variable
`alpha_tab`, a map associating the name of the variable and his alpha value
`incremental_coef` 
*/
type info_system struct {
    tab_coef [][]*big.Rat
    tab_cont []*big.Rat
    tab_nom_var []string
	pos_var_tab []string
	bland []string
	alpha_tab map[string]*big.Rat
    incremental_coef []*big.Rat
    tab_int_bool []bool
}

type branch_and_bound struct {
    solBoolStr bool
    solStr  info_system
}