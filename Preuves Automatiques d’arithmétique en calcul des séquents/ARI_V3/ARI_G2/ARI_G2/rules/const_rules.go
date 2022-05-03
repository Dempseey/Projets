/******************/
/* const_rules.go */
/******************/
/**
* This file provides rules to manage const rules
**/

package ari

import (
	"ARI/types"
	"fmt"
)

/** This function returns true if the constraint fits with artithmetic **/
func constRule(o operation) bool {
	fmt.Printf("Operation : %v\n", o.toString())
	switch o.getOperator() {
	case EQ:
		return o.getArg1() == o.getArg2()
	case NEQ:
		return o.getArg1() != o.getArg2()
	case LESS:
		return o.getArg1().Cmp(o.getArg2()) == -1
	case LESSEQ:
		return o.getArg1().Cmp(o.getArg2()) <= 0
	case GREAT:
		return o.getArg1().Cmp(o.getArg2()) > 0
	case GREATEQ:
		return o.getArg1().Cmp(o.getArg2()) >= 0
	default:
		println("Error constRule - int : operator type unknown")
		return false
	}
}

/***
* Type checker for predicate is_int and is_rat
* Return true if the predicat is is_int or is_rat, plus true if the type fits, false otherwise
**/
func applyTypeRule(p types.Pred) (bool, bool) {
	switch p.GetID().GetName() {
	case "is_int":
		return true, checkIntToProp(p.GetTypeScheme())
	case "is_rat":
		return true, checkRatToProp(p.GetTypeScheme())
	default:
		return false, false
	}
}
