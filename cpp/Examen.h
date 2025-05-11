#pragma once  
#include <string>
class Examen
{
private:
	int m_id;
	std::string m_code;
public:
	Examen(int id, const std::string& code);
	//Examen(const Examen& other) = default; // Copy constructor
	//Examen& operator=(const Examen& other) = default; // Copy assignment operator
	// Getters  
	int getId() const;
	std::string getCode() const;
	void display() const;
};
