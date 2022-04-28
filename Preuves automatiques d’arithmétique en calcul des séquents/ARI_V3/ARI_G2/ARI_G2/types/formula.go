/**************/
/* formula.go */
/**************/
/**
* This file provides functions and datastructures describing a formula.
**/

package types

import (
	typing "ARI/polymorphism"
)

/*** Structure ***/

/* Formula  */
type Form interface {
	ToString() string
	ToStringWithSuffixMeta(string) string
	Copy() Form
	Equals(Form) bool
	GetMetas() MetaList
}

/* Symbol of predicate */
type Pred struct {
	id       Id
	args     []Term
	typeHint typing.TypeScheme
}

func (p Pred) GetID() Id {
	return p.id.Copy().(Id)
}

func (p Pred) GetArgs() []Term {
	return CopyTermList(p.args)
}

func (p Pred) GetTypeScheme() typing.TypeScheme {
	return p.typeHint
}

/* Top (always true) */
type Top struct {
}

/* Bot (always false) */
type Bot struct {
}

/* Not(formula): negation of a formula */
type Not struct {
	f Form
}

func (n Not) GetForm() Form {
	return n.f
}

/* And(formula list): conjunction of formulae */
type And struct {
	lf FormList
}

func (a And) GetLF() FormList {
	return a.lf.Copy()
}

/* Or(formula list): disjunction of formulae */
type Or struct {
	lf FormList
}

func (o Or) GetLF() FormList {
	return o.lf.Copy()
}

/* Imp(f1,f2): f1 imply f2*/
type Imp struct {
	f1, f2 Form
}

func (i Imp) GetF1() Form {
	return i.f1.Copy()
}
func (i Imp) GetF2() Form {
	return i.f2.Copy()
}

/* Equ(f1, f2): f1 equivalent to f2 */
type Equ struct {
	f1, f2 Form
}

func (e Equ) GetF1() Form {
	return e.f1.Copy()
}
func (e Equ) GetF2() Form {
	return e.f2.Copy()
}

type Ex struct {
	var_list []Var
	f        Form
}

func (e Ex) GetVarList() []Var {
	return copyVarList(e.var_list)
}
func (e Ex) GetForm() Form {
	return e.f.Copy()
}

type All struct {
	var_list []Var
	f        Form
}

func (a All) GetVarList() []Var {
	return copyVarList(a.var_list)
}
func (a All) GetForm() Form {
	return a.f.Copy()
}

/*** Methods ***/

/* ToString */
func (p Pred) ToString() string {
	s_res := p.GetID().ToString()
	if len(p.GetArgs()) > 0 {
		s_res += "("
		s_res += p.GetArgs()[0].ToString()
		if len(p.GetArgs()) > 1 {
			s := p.GetArgs()[1:]
			for _, v := range s {
				s_res += ", "
				s_res += v.ToString()
			}
		}
		s_res += ")"
	}
	s_res += "_" + p.GetTypeScheme().ToString()
	return s_res
}
func (Top) ToString() string {
	return "⊤"
}
func (Bot) ToString() string {
	return "⊥"
}
func (n Not) ToString() string {
	return "¬" + n.GetForm().ToString()
}
func (a And) ToString() string {
	s_res := "(" + a.GetLF()[0].ToString()
	s := a.GetLF()[1:]
	for _, v := range s {
		s_res += " ∧ "
		s_res += v.ToString()
	}
	s_res += ")"
	return s_res
}
func (o Or) ToString() string {
	s_res := "(" + o.GetLF()[0].ToString()
	s := o.GetLF()[1:]
	for _, v := range s {
		s_res += " ∨ "
		s_res += v.ToString()
	}
	s_res += ")"
	return s_res
}
func (i Imp) ToString() string {
	return "(" + i.GetF1().ToString() + " ⇒ " + i.GetF2().ToString() + ")"
}
func (e Equ) ToString() string {
	return "(" + e.GetF1().ToString() + " ⇔ " + e.GetF2().ToString() + ")"
}
func (e Ex) ToString() string {
	s_res := "∃ " + e.GetVarList()[0].ToString()
	if len(e.GetVarList()) > 1 {
		s := e.GetVarList()[1:]
		for _, v := range s {
			s_res += ", "
			s_res += v.ToString()
		}
	}
	s_res += " (" + e.GetForm().ToString() + ")"
	return s_res
}
func (a All) ToString() string {
	s_res := "∀ " + a.GetVarList()[0].ToString()
	if len(a.GetVarList()) > 1 {
		s := a.GetVarList()[1:]
		for _, v := range s {
			s_res += ", "
			s_res += v.ToString()
		}
	}
	s_res += " (" + a.GetForm().ToString() + ")"
	return s_res
}

/* ToStringWithSuffixMeta */
func (p Pred) ToStringWithSuffixMeta(suffix string) string {
	s_res := p.GetID().ToString()
	if len(p.GetArgs()) > 0 {
		s_res += "("
		s_res += p.GetArgs()[0].ToStringWithSuffixMeta(suffix)
		if len(p.GetArgs()) > 1 {
			s := p.GetArgs()[1:]
			for _, v := range s {
				s_res += ", "
				s_res += v.ToStringWithSuffixMeta(suffix)
			}
		}
		s_res += ")"
	}
	return s_res
}
func (t Top) ToStringWithSuffixMeta(string) string {
	return t.ToString()
}
func (b Bot) ToStringWithSuffixMeta(string) string {
	return b.ToString()
}
func (n Not) ToStringWithSuffixMeta(string) string {
	return n.ToString()
}
func (a And) ToStringWithSuffixMeta(suffix string) string {
	s_res := "(" + a.GetLF()[0].ToStringWithSuffixMeta(suffix)
	s := a.GetLF()[1:]
	for _, v := range s {
		s_res += " ∧ "
		s_res += v.ToStringWithSuffixMeta(suffix)
	}
	s_res += ")"
	return s_res
}
func (o Or) ToStringWithSuffixMeta(suffix string) string {
	s_res := "(" + o.GetLF()[0].ToStringWithSuffixMeta(suffix)
	s := o.GetLF()[1:]
	for _, v := range s {
		s_res += " ∨ "
		s_res += v.ToStringWithSuffixMeta(suffix)
	}
	s_res += ")"
	return s_res
}
func (i Imp) ToStringWithSuffixMeta(suffix string) string {
	return "(" + i.GetF1().ToStringWithSuffixMeta(suffix) + " ⇒ " + i.GetF2().ToStringWithSuffixMeta(suffix) + ")"
}
func (e Equ) ToStringWithSuffixMeta(suffix string) string {
	return "(" + e.GetF1().ToStringWithSuffixMeta(suffix) + " ⇔ " + e.GetF2().ToStringWithSuffixMeta(suffix) + ")"
}
func (e Ex) ToStringWithSuffixMeta(suffix string) string {
	s_res := "∃ " + e.GetVarList()[0].ToString()
	if len(e.GetVarList()) > 1 {
		s := e.GetVarList()[1:]
		for _, v := range s {
			s_res += ", "
			s_res += v.ToString()
		}
	}
	s_res += " (" + e.GetForm().ToStringWithSuffixMeta(suffix) + ")"
	return s_res
}
func (a All) ToStringWithSuffixMeta(suffix string) string {
	s_res := "∀ " + a.GetVarList()[0].ToString()
	if len(a.GetVarList()) > 1 {
		s := a.GetVarList()[1:]
		for _, v := range s {
			s_res += ", "
			s_res += v.ToString()
		}
	}
	s_res += " (" + a.GetForm().ToStringWithSuffixMeta(suffix) + ")"
	return s_res
}

/* Copy */
func (p Pred) Copy() Form {
	res := MakePred(p.GetID(), p.GetArgs(), p.GetTypeScheme())
	return res
}
func (Top) Copy() Form {
	return MakeTop()
}
func (Bot) Copy() Form {
	return MakeBot()
}
func (n Not) Copy() Form {
	return MakeNot(n.GetForm())
}
func (a And) Copy() Form {
	return MakeAnd(a.GetLF())
}
func (o Or) Copy() Form {
	return MakeOr(o.GetLF())
}
func (i Imp) Copy() Form {
	return MakeImp(i.GetF1(), i.GetF2())
}
func (e Equ) Copy() Form {
	return MakeEqu(e.GetF1(), e.GetF2())
}
func (e Ex) Copy() Form {
	return MakeEx(copyVarList(e.GetVarList()), e.GetForm())
}
func (a All) Copy() Form {
	return MakeAll(copyVarList(a.GetVarList()), a.GetForm())
}

/* Equals */
func (p Pred) Equals(f Form) bool {
	switch nf := f.(type) {
	case Pred:
		return nf.GetID().Equals(p.GetID()) && AreEqualsTermList(nf.GetArgs(), p.GetArgs())
	default:
		return false
	}
}
func (Top) Equals(f Form) bool {
	switch f.(type) {
	case Top:
		return true
	default:
		return false
	}
}
func (Bot) Equals(f Form) bool {
	switch f.(type) {
	case Bot:
		return true
	default:
		return false
	}
}
func (n Not) Equals(f Form) bool {
	switch nf := f.(type) {
	case Not:
		return nf.GetForm().Equals(n.GetForm())
	default:
		return false
	}
}
func (a And) Equals(f Form) bool {
	switch nf := f.(type) {
	case And:
		return nf.GetLF().Equals(a.GetLF())
	default:
		return false
	}
}
func (o Or) Equals(f Form) bool {
	switch nf := f.(type) {
	case Or:
		return nf.GetLF().Equals(o.GetLF())
	default:
		return false
	}
}
func (i Imp) Equals(f Form) bool {
	switch nf := f.(type) {
	case Imp:
		return i.GetF1().Equals(nf.GetF1()) && i.GetF2().Equals(nf.GetF2())
	default:
		return false
	}
}
func (e Equ) Equals(f Form) bool {
	switch nf := f.(type) {
	case Equ:
		return e.GetF1().Equals(nf.GetF1()) && e.GetF2().Equals(nf.GetF2())
	default:
		return false
	}
}
func (e Ex) Equals(f Form) bool {
	switch nf := f.(type) {
	case Ex:
		return AreEqualsVarList(e.GetVarList(), nf.GetVarList()) && e.GetForm().Equals(nf.GetForm())
	default:
		return false
	}
}
func (a All) Equals(f Form) bool {
	switch nf := f.(type) {
	case All:
		return AreEqualsVarList(a.GetVarList(), nf.GetVarList()) && a.GetForm().Equals(nf.GetForm())
	default:
		return false
	}
}

/* Get Metavariable of the formula */
func (p Pred) GetMetas() MetaList {
	res := MakeEmptyMetaList()
	for _, m := range p.GetArgs() {
		switch mt := m.(type) {
		case Meta:
			res = res.AppendIfNotContains(mt)
		}
	}
	return res
}
func (Top) GetMetas() MetaList {
	return MakeEmptyMetaList()
}
func (Bot) GetMetas() MetaList {
	return MakeEmptyMetaList()
}
func (n Not) GetMetas() MetaList {
	return n.GetForm().GetMetas()
}
func (a And) GetMetas() MetaList {
	res := MakeEmptyMetaList()
	for _, f := range a.GetLF() {
		res = res.Merge(f.GetMetas())
	}
	return res
}
func (o Or) GetMetas() MetaList {
	res := MakeEmptyMetaList()
	for _, f := range o.GetLF() {
		res = res.Merge(f.GetMetas())
	}
	return res
}
func (i Imp) GetMetas() MetaList {
	return i.f1.GetMetas().Merge(i.f2.GetMetas())
}
func (e Equ) GetMetas() MetaList {
	return e.f1.GetMetas().Merge(e.f2.GetMetas())
}
func (e Ex) GetMetas() MetaList {
	return e.GetForm().GetMetas()
}
func (a All) GetMetas() MetaList {
	return a.GetForm().GetMetas()
}

/*** Functions ***/

/* Makers */
func MakePred(p Id, tl []Term, ts ...typing.TypeScheme) Pred {
	if len(ts) == 1 {
		return Pred{p, tl, ts[0]}
	} else {
		return Pred{p, tl, typing.DefaultPropType(len(tl))}
	}
}
func MakeTop() Top {
	return Top{}
}
func MakeBot() Bot {
	return Bot{}
}
func MakeNot(f Form) Not {
	return Not{f}
}
func MakeAnd(fl FormList) And {
	return And{fl}
}
func MakeOr(fl FormList) Or {
	return Or{fl}
}
func MakeImp(f1, f2 Form) Imp {
	return Imp{f1, f2}
}
func MakeEqu(f1, f2 Form) Equ {
	return Equ{f1, f2}
}
func MakeEx(vl []Var, f Form) Ex {
	return Ex{vl, f}
}
func MakeAll(vl []Var, f Form) All {
	return All{vl, f}
}

/* Create a FormAndTerm element without meta */
func MakeForm(f Form) Form {
	return f.Copy()
}

/* Transform a formula into its negation */
func RefuteForm(f Form) Form {
	new_f, changed := rewriteNEQ(f)
	if changed {
		return new_f
	} else {
		return MakeNot(new_f)
	}
}

/* if a not(eq) is found, transormf it into != */
func rewriteNEQ(f Form) (Form, bool) {
	if not_eq, ok := f.(Pred); ok {
		if not_eq.GetID().Equals(Id_eq) {
			return MakePred(Id_neq, not_eq.GetArgs()), true
		}
	}
	return f, false
}

/** Replace a Var by a term - Useful functions for Delta and Gamma rules (replace var by term) **/

/* Replace a var by a term */
func ReplaceVarByTerm(f Form, old_symbol Var, new_symbol Term) Form {
	switch nf := f.(type) {
	case Pred:
		// Be careful about the type here, the correctness of doing this has not been thoroughly checked.
		return MakePred(nf.GetID(), replaceVarInTermList(nf.GetArgs(), old_symbol, new_symbol), nf.GetTypeScheme())
	case Top:
		return f
	case Bot:
		return f
	case Not:
		return MakeNot(ReplaceVarByTerm(nf.GetForm(), old_symbol, new_symbol))
	case And:
		var res FormList
		for _, val := range nf.GetLF() {
			res = append(res, ReplaceVarByTerm(val, old_symbol, new_symbol))
		}
		return MakeAnd(res)
	case Or:
		var res FormList
		for _, val := range nf.GetLF() {
			res = append(res, ReplaceVarByTerm(val, old_symbol, new_symbol))
		}
		return MakeOr(res)
	case Imp:
		return MakeImp(ReplaceVarByTerm(nf.GetF1(), old_symbol, new_symbol), ReplaceVarByTerm(nf.GetF2(), old_symbol, new_symbol))
	case Equ:
		return MakeEqu(ReplaceVarByTerm(nf.GetF1(), old_symbol, new_symbol), ReplaceVarByTerm(nf.GetF2(), old_symbol, new_symbol))
	case Ex:
		return MakeEx(nf.GetVarList(), ReplaceVarByTerm(nf.GetForm(), old_symbol, new_symbol))
	case All:
		return MakeAll(nf.GetVarList(), ReplaceVarByTerm(nf.GetForm(), old_symbol, new_symbol))
	default:
		return nil
	}
}

/* Replace a Var by a term inside a function */
func replaceVarInTermList(original_list []Term, old_symbol Var, new_symbol Term) []Term {
	new_list := make([]Term, len(original_list))
	for i, val := range original_list {
		switch nf := val.(type) {
		case Var:
			if old_symbol.Equals(nf) {
				new_list[i] = new_symbol
			} else {
				new_list[i] = val
			}
		case Fun:
			new_list[i] = MakerFun(nf.GetP(), replaceVarInTermList(nf.GetArgs(), old_symbol, new_symbol), nf.GetTypeHint())
		default:
			new_list[i] = val
		}
	}
	return new_list
}

/** Replace a Var by a Var - for parser **/

/* rename variable if any */
func RenameVariables(f Form) Form {
	switch nf := f.(type) {
	case Pred:
		return f
	case Top:
		return f
	case Bot:
		return f
	case Not:
		return MakeNot(RenameVariables(nf.GetForm()))
	case And:
		var res FormList
		for _, val := range nf.GetLF() {
			res = append(res, RenameVariables(val))
		}
		return MakeAnd(res)
	case Or:
		var res FormList
		for _, val := range nf.GetLF() {
			res = append(res, RenameVariables(val))
		}
		return MakeOr(res)
	case Imp:
		return MakeImp(RenameVariables(nf.GetF1()), RenameVariables(nf.GetF2()))
	case Equ:
		return MakeEqu(RenameVariables(nf.GetF1()), RenameVariables(nf.GetF2()))

	case Ex:
		new_vl := copyVarList(nf.GetVarList())
		new_form := nf.GetForm()

		for _, v := range nf.GetVarList() {
			new_var := MakerNewVar(v.GetName(), v.GetTypeHint())
			new_vl = replaceVarInVarList(new_vl, v, new_var)
			new_form = ReplaceVarByTerm(RenameVariables(new_form), v, new_var)

		}
		return MakeEx(new_vl, new_form)

	case All:
		new_vl := copyVarList(nf.GetVarList())
		new_form := nf.GetForm()

		for _, v := range nf.GetVarList() {
			new_var := MakerNewVar(v.GetName(), v.GetTypeHint())
			new_vl = replaceVarInVarList(new_vl, v, new_var)
			new_form = ReplaceVarByTerm(RenameVariables(new_form), v, new_var)

		}
		return MakeAll(new_vl, new_form)

	default:
		return f
	}
}

/* replace a var by another in a var list */
func replaceVarInVarList(vl []Var, v1, v2 Var) []Var {
	res := []Var{}
	for _, v := range vl {
		if v.Equals(v1) {
			res = append(res, v2)
		} else {
			res = append(res, v)
		}
	}
	return res
}
