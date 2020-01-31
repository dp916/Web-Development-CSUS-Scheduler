<?php

	class adcalendar {

		public function adcalendar(){

		}

		private $daysofweek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" );
		private $year = 0;
		private $month = 0;
		private $day = 0;
		private $daysinmonth = 0;
		private $todaysdate = null;

		private function generateDays(){

			$this->$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $currentmonth, $currentyear);


		}

	}