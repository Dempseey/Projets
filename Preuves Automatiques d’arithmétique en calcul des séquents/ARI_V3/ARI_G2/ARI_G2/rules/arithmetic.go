/*****************/
/* Arithmetic.go */
/*****************/
/**
* This file provides the interface to communicate with the arithmeic module
**/

package ari

import (
	treetypes "ARI/tree-types"
	"ARI/types"
	"fmt"
	"math/big"
)

/** Apply const rule
* Take a predicate
* Search a contradiction inside
* Return false if the corresponding artihmetic opration is correct, true otherwise
**/
func ApplyConstRule(p types.Pred) bool {

	switch {
	case checkUnaryArithmeticPredicate(p.GetID()):
		found, res := applyTypeRule(p)
		if found {
			return !res
		}
		return false

	case checkBinaryArithmeticPredicate(p.GetID()):
		operation, error := predToOperation(p)
		if error != nil {
			fmt.Printf("PredToOp error\n")
			return false
		}
		return !constRule(operation)
	default:
		return false

	}
}

/** Apply normalization rule
* Take a predicate
* Normalize it
* Return a list of new predicates to add to the proof search
**/
func ApplyNormalizationRule(p types.Form) []types.FormList {
	res_default := []types.FormList{types.MakeSingleElementList(p)}

	switch pt := p.(type) {
	case types.Pred:
		// If there is the predicate is not an arithmetic predicate
		if !checkBinaryArithmeticPredicate(pt.GetID()) {
			return res_default
		} else {
			return normalizationRule(pt)
		}
	case types.Not:
		switch pt_not_t := pt.GetForm().(type) {
		case types.Pred:
			// If there is the predicate is not an arithmetic predicate
			if !checkBinaryArithmeticPredicate(pt_not_t.GetID()) {
				return res_default
			} else {
				return normalizationNegRule(pt_not_t)
			}
		default:
			return res_default
		}
	default:
		return res_default
	}
}

/** Apply Simplex Rule
* Apply simplex on a list of Form
* Return a bool (solution found or not) and a substitution
**/
func ApplySimplexRule(fl types.FormList) (bool, treetypes.Substitutions) {
	// Keep only relevant predicat, aka arithmetic predicat with binary arity and a variable like x <= 3...
	pred_list_for_simplex := keepRelevantPred(fl)
	// Normalization to fits with simplex's input
	normalized_pred_list, map_metavariable_simplexvariables := normalizeForSimplex(pred_list_for_simplex)
	// Call to simplex, return something like variable - value
	 res_simplex,has_solution := Simplexe(normalized_pred_list)
	 fmt.Println("finito")
	if !has_solution {
		fmt.Println("pippo")
		return false, treetypes.MakeEmptySubstitution()
	}
	var solution = make(map[string]*big.Rat,0)
	for i:=0;i<len(res_simplex.tab_nom_var);i++{
		solution[res_simplex.tab_nom_var[i]]=res_simplex.alpha_tab[res_simplex.tab_nom_var[i]]
	}
	// Rebuild a substitution from the simplex's result
	subst_res := buildSubstitutionFromSimplexResult(solution, map_metavariable_simplexvariables)

	return true, subst_res
}
