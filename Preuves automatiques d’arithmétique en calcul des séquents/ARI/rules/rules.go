/************/
/* rules.go */
/************/
/**
* This file provides rules to manage artihmetic into proof-search.
**/

package ari

import ("ARI/types"
		"strconv"
)
func ApplyConstRule(p types.Pred) bool {
	o := PredToConst(p)
	if o == nil {
		return false
	}
	return constRule1(o)
}

// TODO : cas rationnel
func constRule1(o operation) bool {
	// En fonction du type de mon opération
	switch opType := o.(type) {

	// Cas entier
	case operationInt:
		switch opType.getOperator() {
		case EQ:
			return opType.getArg1() == opType.getArg2()
		case NEQ:
			return opType.getArg1() != opType.getArg2()
		}

	// Cas rationnel (rien a changer grace a Julie)
	case operationRat:
		switch opType.getOperator() {
		case EQ:
			return opType.getArg1() == opType.getArg2()
		case NEQ:
			return opType.getArg1() != opType.getArg2()
		}

	default:
		println("Error constRule1")
		return false
	}

	println("Error constRule1")
	return false
}

// TODO : Compléter avec les règle int-LT et INt-GT
func NormalizationRule(p types.Pred) []types.FormList {
	res := []types.FormList{}
	arg1 := p.GetArgs()[0]
	arg2 := p.GetArgs()[1]

	switch p.GetID().GetName() {
	case types.Id_eq.GetName():
		res_form_list := types.MakeEmptyFormList()
		res_form_list = append(res_form_list, types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), arg2.Copy()}))
		res_form_list = append(res_form_list, types.MakePred(types.MakerId("lesseq"), []types.Term{arg2.Copy(), arg1.Copy()}))
		return append(res, res_form_list)

	case types.Id_neq.GetName():
		res_form_list := types.MakeEmptyFormList()
		res_form_list = append(res_form_list, types.MakePred(types.MakerId("less"), []types.Term{arg1.Copy(), arg2.Copy()}))
		res_form_list = append(res_form_list, types.MakePred(types.MakerId("greater"), []types.Term{arg2.Copy(), arg1.Copy()}))
		return append(res, res_form_list)

	case "less":
		res_form_list := types.MakeEmptyFormList()

		y, _ := strconv.Atoi(arg2.GetName())
		Sy:=strconv.Itoa(y-1)
		nouveau_arg2 := types.MakerConst(types.MakerId(Sy), tInt)

		res_form_list = append(res_form_list, types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), nouveau_arg2.Copy()}))
		return append(res, res_form_list)

	case "greater":
		res_form_list := types.MakeEmptyFormList()

		y, _ := strconv.Atoi(arg2.GetName())
		Sy:=strconv.Itoa(y+1)
		nouveau_arg2 := types.MakerConst(types.MakerId(Sy), tInt)

		res_form_list = append(res_form_list, types.MakePred(types.MakerId("greateq"), []types.Term{arg1.Copy(), nouveau_arg2.Copy()}))
		return append(res, res_form_list)
	}
	return res
}


func NormalizationNegRule(f types.Form) []types.FormList{
	res := []types.FormList{}
	if typeNot, isNot:= f.(types.Not); isNot {
		if typePred,isPred:= typeNot.GetForm().(types.Pred); isPred{
			arg1 := typePred.GetArgs()[0]
			arg2 := typePred.GetArgs()[1]
			switch typePred.GetID().GetName(){
				case "less":
					res_form_list := types.MakeEmptyFormList()
					res_form_list = append(res_form_list, types.MakePred(types.MakerId("greateq"), []types.Term{arg1.Copy(), arg2.Copy()}))
					return append(res, res_form_list)
			
				case "greater":
					res_form_list := types.MakeEmptyFormList()
					res_form_list = append(res_form_list, types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), arg2.Copy()}))
					return append(res, res_form_list)
			
				case "lesseq":
					res_form_list := types.MakeEmptyFormList()
					res_form_list = append(res_form_list, types.MakePred(types.MakerId("greater"), []types.Term{arg1.Copy(), arg2.Copy()}))
					return append(res, res_form_list)
			
				case "greatereq":
					res_form_list := types.MakeEmptyFormList()
					res_form_list = append(res_form_list, types.MakePred(types.MakerId("less"), []types.Term{arg1.Copy(), arg2.Copy()}))
					return append(res, res_form_list)
			
			}
	}

	}
	return res
}



