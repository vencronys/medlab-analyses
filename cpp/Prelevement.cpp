#include "Prelevement.h"

Prelevement::Prelevement(int id, int size)
	: m_examens(size)
{
	m_id = id;
}

int Prelevement::getId() const { return m_id; }
Examens Prelevement::getExamens() const { return m_examens; }

void Prelevement::addExamen(const int& id, const char* code) {
	m_examens.addExamen(id, code);
}