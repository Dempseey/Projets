/********************/
/* formula_liste.go */
/********************/
/**
* This file provides functions and datastructures describing a list of formulas.
**/

package types

import (
	"sort"
)

/*** Structure ***/

/* List of formulae */
type FormList []Form

/*** Methods ***/

/*Sort */
func (fl FormList) Len() int      { return len(fl) }
func (fl FormList) Swap(i, j int) { fl[i], fl[j] = fl[j], fl[i] }
func (fl FormList) Less(i, j int) bool {
	return (fl[i].ToString() < fl[j].ToString())
}

/** To String **/

/* Convert a list of formulas into string*/
func (fl FormList) ToString() string {
	res := "{"
	for i, v := range fl {
		res += v.ToString()
		if i < len(fl)-1 {
			res += (", ")
		}
	}
	res += "}"
	return res
}

/* Convert a list of formulas into string for proof struct */
func (fl FormList) ToStringForProof() string {
	res := ""
	for i, f := range fl {
		res = res + "<tspan x='0', dy='1.2em'>" + f.ToString() + "<tspan>"
		if i < len(fl)-1 {
			res = res + ", "
		}
	}
	return res
}

/** Utilitary **/

/* Return true is the FormList is empty, false otherwise */
func (fl FormList) IsEmpty() bool {
	return len(fl) <= 0
}

/* Copy a list of form */
func (fl FormList) Copy() FormList {
	res := make([]Form, len(fl))
	for i := range fl {
		res[i] = fl[i].Copy()
	}
	return res
}

/* Check if two form_and_term_list contains the same elements */
func (l1 FormList) Equals(l2 FormList) bool {
	if len(l1) != len(l2) {
		return false
	} else {
		l1_sorted := l1.Copy()
		sort.Sort(l1_sorted)

		l2_sorted := l2.Copy()
		sort.Sort(l2_sorted)

		for i := range l1_sorted {
			if !l1_sorted[i].Equals(l2_sorted[i]) {
				return false
			}
		}
	}
	return true
}

/* Return true if a formula f is inside the given formulas list, false otherwise */
func (fl FormList) Contains(f Form) bool {
	for _, v := range fl {
		if f.Equals(v) {
			return true
		}
	}
	return false
}

/* Append a formula to a list if the formula is not already inside */
func (fl FormList) AppendIfNotContains(f Form) FormList {
	if fl.Contains(f) {
		return fl.Copy()
	} else {
		return append(fl.Copy(), f)
	}
}

/* Merge two formulas lists */
func (l1 FormList) Merge(l2 FormList) FormList {
	res := l1.Copy()
	for _, f := range l2 {
		res = res.AppendIfNotContains(f.Copy())
	}
	return res
}

/*** Functions ***/

/** Makers **/

/* Make empty form_and_term_list */
func MakeEmptyFormList() FormList {
	return FormList{}
}

/* Make a form_and_term_list with one element */
func MakeSingleElementList(f Form) FormList {
	return FormList{f}
}
