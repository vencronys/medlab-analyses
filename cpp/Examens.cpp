#include "Examens.h"

Examens::Examens(int size) {
	m_size = size;
	m_nextPos = 0;
	m_examens = new Examen * [size];
}

Examens::Examens(const Examens& other) {
	m_size = other.m_size;
	m_examens = new Examen * [m_size];
	for (int i = 0; i < m_size; ++i) {
		m_examens[i] = new Examen(other.m_examens[i][0]);
		m_nextPos++;
	}
}
Examens::~Examens() {
	for (int i = 0; i < m_size; i++) {
		delete m_examens[i];
	}
	delete[] m_examens;
}
Examens& Examens::operator=(const Examens& other) {
	if (this == &other) {
		return *this;
	}
	for (int i = 0; i < m_size; i++) {
		delete m_examens[i];
	}
	delete[] m_examens;
	m_size = other.m_size;
	m_examens = new Examen * [m_size];
	for (int i = 0; i < m_size; ++i) {
		m_examens[i] = new Examen(other.m_examens[i][0]);
	}
	return *this;
}

void Examens::display() const {
	for (int i = 0; i < m_size; ++i) {
		m_examens[i][0].display();
	}
}

Examen& Examens::operator[](int index) const {
	return m_examens[index][0];
}

int Examens::getSize() const { return m_size; }

void Examens::addExamen(const int& id, const char* code) {
	m_examens[m_nextPos++] = new Examen(id, code);
}