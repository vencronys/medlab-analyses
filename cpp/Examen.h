#pragma once  
#include <string>
class Examen
{
private:
	int m_id;
	std::string m_code;
public:
	Examen(int id, const std::string& code);
	int getId() const;
	std::string getCode() const;
	void display() const;
};
