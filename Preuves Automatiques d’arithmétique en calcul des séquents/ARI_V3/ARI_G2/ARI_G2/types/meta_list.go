/*****************/
/* meta_liste.go */
/*****************/
/**
* This file contains functions and datastructures describing a list of metavariables.
**/

package types

import (
	"sort"
	"strconv"
)

/* Meta function for sort */
type MetaList []Meta

func (m MetaList) Len() int      { return len(m) }
func (m MetaList) Swap(i, j int) { m[i], m[j] = m[j], m[i] }
func (m MetaList) Less(i, j int) bool {
	return (m[i].GetName() + strconv.Itoa(m[i].GetIndex())) < (m[j].GetName() + strconv.Itoa(m[j].GetIndex()))
}

/* Print a list of metas */
func (ml MetaList) ToString() string {
	var s_res string
	for i, v := range ml {
		s_res += v.ToString()
		if i < len(ml)-1 {
			s_res += (", ")
		}
	}
	return s_res
}

/* Check if a meta is inside a given list of metavariables */
func (ml MetaList) Contains(m Meta) bool {
	for _, v := range ml {
		if v == m {
			return true
		}
	}
	return false
}

/* Append a meta to a meta list if it not already inside */
func (ml MetaList) AppendIfNotContains(m Meta) MetaList {
	if ml.Contains(m) {
		return ml
	} else {
		return append(ml, m)
	}
}

/* check if two metalist have metavariables in common */
func (m1 MetaList) HasInCommon(m2 MetaList) bool {
	for _, meta := range m1 {
		if m2.Contains(meta) {
			return true
		}
	}
	return false
}

/* Check if a list of meta is includ in another */
func (ml MetaList) IsInclude(ml2 MetaList) bool {
	for _, meta := range ml2 {
		if !ml2.Contains(meta) {
			return false
		}
	}

	return true
}

/* Copy  a MetaList */
func (ml MetaList) Copy() MetaList {
	res := make(MetaList, len(ml))
	for i := range ml {
		res[i] = ml[i].Copy().ToMeta()
	}
	return res
}

/* Check if a list of meta is empty */
func (ml MetaList) IsEmpty() bool {
	return len(ml) <= 0
}

/* Check if two metalist contains the same elements */
func (l1 MetaList) Equals(l2 MetaList) bool {
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

/* Maker */
func MakeEmptyMetaList() MetaList {
	return MetaList{}
}

/* MetaList to term list */
func (ml MetaList) ToTermList() []Term {
	res := []Term{}
	for _, m := range ml {
		res = append(res, m)
	}
	return res
}

/* Merge two meta list */
func (l1 MetaList) Merge(l2 MetaList) MetaList {
	res := l1.Copy()
	for _, f := range l2 {
		res = res.AppendIfNotContains(f.Copy().ToMeta())
	}
	return res
}
