<?php
	Class View {
		public function render($filename, $value = []) {
			$data = $value;
			require_once "views/".$filename.".php";
		}
	}