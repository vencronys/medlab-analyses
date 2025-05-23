#include "Examen.h"
#include <iostream>

Examen::Examen(int id, const std::string & code) {
	m_id = id;
	m_code = code;
}

int Examen::getId() const { return m_id; }
std::string Examen::getCode() const { return m_code; }
void Examen::display() const {
	std::cout << "Examen ID: " << m_id << ", Code: " << m_code << "\n";
}