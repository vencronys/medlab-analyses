#include "Prelevement.h"
#include "Logger.h"

Prelevement::Prelevement(int id, int size)
	: m_examens(size)
{
	m_id = id;
}

int Prelevement::getId() const { return m_id; }
Examens Prelevement::getExamens() const { return m_examens; }

void Prelevement::addExamen(const int& id, const char* code) {
	Logger logger("application.log");
	m_examens.addExamen(id, code);
	logger.log("Added exam with ID: " + std::to_string(id) + " and code: " + std::string(code), Logger::LogLevel::INFO);
}