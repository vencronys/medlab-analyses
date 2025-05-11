#pragma once
#include "Examen.h"
class Examens
{
private:
	int m_size;
	int m_nextPos;
	Examen** m_examens;
public:
	Examens(int size);
	Examens(const Examens&);
	~Examens();
	Examens& operator=(const Examens&);

	void display() const;

	Examen& operator[](int index) const;

	int getSize() const;

	void addExamen(const int& id, const char* code);
};

