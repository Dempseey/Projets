/**************************/
/* normalization_rules.go */
/**************************/
/**
* This file provides rules to manage normalization rules
**/

package ari

import (
	typing "ARI/polymorphism"
	"ARI/types"
	"math/big"
)

func normalizationRule(p types.Pred) []types.FormList {
	res := []types.FormList{}
	arg1 := p.GetArgs()[0]
	arg2 := p.GetArgs()[1]
	res_form_list := types.MakeEmptyFormList()

	switch p.GetID().GetName() {
	// EQ rule
	case types.Id_eq.GetName():
		res_form_list = append(res_form_list, types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), arg2.Copy()}))
		res_form_list = append(res_form_list, types.MakePred(types.MakerId("lesseq"), []types.Term{arg2.Copy(), arg1.Copy()}))
		return []types.FormList{res_form_list}

	// NEQ rule
	case types.Id_neq.GetName():
		res = append(res, types.MakeSingleElementList(types.MakePred(types.MakerId("less"), []types.Term{arg1.Copy(), arg2.Copy()})))
		res = append(res, types.MakeSingleElementList(types.MakePred(types.MakerId("greater"), []types.Term{arg2.Copy(), arg1.Copy()})))
		return res

	// int-LT - x < value, value < x, Y < X
	case "less":
		switch arg_1_t := arg1.(type) {
		case types.Meta:
			if typing.IsInt(arg_1_t.GetTypeHint()) {
				switch arg_2_t := arg2.(type) {
				case types.Fun:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						var new_arg_2 types.Fun
						if arg_2_rat, err := evaluateTerm(arg2); err != nil {
							new_arg_2 = types.MakerFun(types.MakerId("$difference"), []types.Term{arg_2_t, types.MakerConst(types.MakerId("1"))}, tInt)
						} else {
							new_arg_2_result := newRat().Sub(arg_2_rat, newRat().SetInt(big.NewInt(1)))
							new_arg_2 = types.MakerConst(types.MakerId(new_arg_2_result.String()), tInt)
						}
						res_lt_int := types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}
				case types.Meta:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						new_arg_2 := types.MakerFun(types.MakerId("$difference"), []types.Term{arg_2_t, types.MakerConst(types.MakerId("1"))}, tInt)
						res_lt_int := types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}
				}
			}
		case types.Fun:
			if typing.IsInt(arg_1_t.GetTypeHint()) {
				switch arg_2_t := arg2.(type) {
				case types.Meta:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						var new_arg_2 types.Fun
						if arg_2_rat, err := evaluateTerm(arg1); err != nil {
							new_arg_2 = types.MakerFun(types.MakerId("$difference"), []types.Term{arg_1_t, types.MakerConst(types.MakerId("1"))}, tInt)
						} else {
							new_arg_2_result := newRat().Sub(arg_2_rat, newRat().SetInt(big.NewInt(1)))
							new_arg_2 = types.MakerConst(types.MakerId(new_arg_2_result.String()), tInt)
						}
						res_lt_int := types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}

				case types.Fun:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						var new_arg_2 types.Fun
						if arg_2_rat, err := evaluateTerm(arg1); err != nil {
							new_arg_2 = types.MakerFun(types.MakerId("$difference"), []types.Term{arg_1_t, types.MakerConst(types.MakerId("1"))}, tInt)
						} else {
							new_arg_2_result := newRat().Sub(arg_2_rat, newRat().SetInt(big.NewInt(1)))
							new_arg_2 = types.MakerConst(types.MakerId(new_arg_2_result.String()), tInt)
						}
						res_lt_int := types.MakePred(types.MakerId("lesseq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}
				}
			}

		}
		return []types.FormList{types.MakeSingleElementList(p)}

	// int-GT
	case "greater":
		switch arg_1_t := arg1.(type) {
		case types.Meta:
			if typing.IsInt(arg_1_t.GetTypeHint()) {
				switch arg_2_t := arg2.(type) {
				case types.Fun:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						var new_arg_2 types.Fun
						if arg_2_rat, err := evaluateTerm(arg2); err != nil {
							new_arg_2 = types.MakerFun(types.MakerId("$sum"), []types.Term{arg_2_t, types.MakerConst(types.MakerId("1"))}, tInt)
						} else {
							new_arg_2_result := newRat().Add(arg_2_rat, newRat().SetInt(big.NewInt(1)))
							new_arg_2 = types.MakerConst(types.MakerId(new_arg_2_result.String()), tInt)
						}
						res_lt_int := types.MakePred(types.MakerId("greateq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}
				case types.Meta:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						new_arg_2 := types.MakerFun(types.MakerId("$sum"), []types.Term{arg_2_t, types.MakerConst(types.MakerId("1"))}, tInt)
						res_lt_int := types.MakePred(types.MakerId("greateq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}
				}
			}
		case types.Fun:
			if typing.IsInt(arg_1_t.GetTypeHint()) {
				switch arg_2_t := arg2.(type) {
				case types.Meta:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						var new_arg_2 types.Fun
						if arg_2_rat, err := evaluateTerm(arg1); err != nil {
							new_arg_2 = types.MakerFun(types.MakerId("$sum"), []types.Term{arg_1_t, types.MakerConst(types.MakerId("1"))}, tInt)
						} else {
							new_arg_2_result := newRat().Add(arg_2_rat, newRat().SetInt(big.NewInt(1)))
							new_arg_2 = types.MakerConst(types.MakerId(new_arg_2_result.String()), tInt)
						}
						res_lt_int := types.MakePred(types.MakerId("greateq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}

				case types.Fun:
					if typing.IsInt(arg_2_t.GetTypeHint()) {
						var new_arg_2 types.Fun
						if arg_2_rat, err := evaluateTerm(arg1); err != nil {
							new_arg_2 = types.MakerFun(types.MakerId("$sum"), []types.Term{arg_1_t, types.MakerConst(types.MakerId("1"))}, tInt)
						} else {
							new_arg_2_result := newRat().Add(arg_2_rat, newRat().SetInt(big.NewInt(1)))
							new_arg_2 = types.MakerConst(types.MakerId(new_arg_2_result.String()), tInt)
						}
						res_lt_int := types.MakePred(types.MakerId("greateq"), []types.Term{arg1.Copy(), new_arg_2}, tInt)
						return []types.FormList{types.MakeSingleElementList(res_lt_int)}
					}
				}
			}
		}
		return []types.FormList{types.MakeSingleElementList(p)}

	default:
		return append(res, types.MakeSingleElementList(p))
	}
}

func normalizationNegRule(p types.Pred) []types.FormList {
	res := []types.FormList{}
	arg1 := p.GetArgs()[0]
	arg2 := p.GetArgs()[1]
	switch p.GetID().GetName() {
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
	return res
}
