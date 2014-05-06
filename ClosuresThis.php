<?php
/*
	Scope of pseudo-variable $this and Closures
	Class Staircase is made of steps whose total numbers can be calculated through 2 methods
*/
class Staircase
{
	/*
		Initialises a staircase
		@param : number of steps
	*/
	function __construct($numberOfSteps) {
		$this->numberOfSteps = $numberOfSteps;
	}
	
	/*
		Calculates the total number of Steps of a building
		@return closure (PHP>=5.3)
	*/
	function buildingNumberOfSteps()
	{
		//A closure is a function aware of its environment of definition
		//In PHP, we have to specify which elements in this environment will be needed, implementing "use" statement
		$thisCopy = $this;
		return function($storeysNumber) use ($thisCopy)
			{
				return $storeysNumber*$thisCopy->numberOfSteps;
			};
	}
	
	/*
		Calculates the total number of Steps of a building including basement
		@return closure (PHP>=5.4)
	*/
	function buildingNumberOfStepsIncludingBasement()
	{
		return function($storeysNumber) 
			{
				return ($storeysNumber + 1)*$this->numberOfSteps;
			};
	}
}

$staircase = new Staircase(25);
$numberOfStepsToReachRoofTopFromGround 	 = $staircase->buildingNumberOfSteps();
$numberOfStepsToReachRoofTopFromBasement = $staircase->buildingNumberOfStepsIncludingBasement();

echo "5.3 <= PHP < 5.4 only allows me to climb from the ground... the ".$numberOfStepsToReachRoofTopFromGround(5)." steps :( ... ";
echo "but with PHP >= 5.4 I can make my way from the basement to the top, climbing the ".$numberOfStepsToReachRoofTopFromBasement(5)." steps ! :D";
