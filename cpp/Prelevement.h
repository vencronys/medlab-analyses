#pragma once
#include "Examens.h"
class Prelevement
{
private:
	int m_id;
	Examens m_examens;
public:
	Prelevement(int id, int size);
	int getId() const;
	Examens getExamens() const;
	void addExamen(const int &id, const char* code);
};

