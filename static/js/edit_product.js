"use strict";

var currentSize = $('input[name="size"]').val().split(',');
var sizeName = {
	"42": {
		size: 42,
		checked: false
	},
	"44": {
		size: 44,
		checked: false
	},
	"46": {
		size: 46,
		checked: false
	},
	"48": {
		size: 48,
		checked: false
	},
	"50": {
		size: 50,
		checked: false
	},
	"52": {
		size: 52,
		checked: false
	},
	"54": {
		size: 54,
		checked: false
	},
	"56": {
		size: 56,
		checked: false
	},
	"58": {
		size: 58,
		checked: false
	},
	"60": {
		size: 60,
		checked: false
	}
};
function checkSize() {
	for (var key in sizeName) {
		for (var i = 0; i < currentSize.length; i++) {
			if (currentSize[i] == sizeName[key]["size"]) {
				sizeName[key]["checked"] = true;
			}
		}
	}
	createCheckBox();
}
checkSize();
function createCheckBox() {
	for (var key in sizeName) {
		if (sizeName[key]['checked'] === true) {
			$('.size_chois').append(sizeName[key]["size"] + '<input type="checkbox" value="' + sizeName[key]["size"] + '" name="size_chois" checked>');
		} else {
			$('.size_chois').append(sizeName[key]["size"] + '<input type="checkbox" value="' + sizeName[key]["size"] + '" name="size_chois">');
		}
	}
}
//Изменение размера
$('input[name="size_chois"]').on('change', function () {
	if (this.checked) {
		if ($('input[name="size"]').val().length <= 1) {
			$('input[name="size"]').val($('input[name="size"]').val() + this.value);
		} else {
			$('input[name="size"]').val($('input[name="size"]').val() + "," + this.value);
		}
	} else if (this.checked === false) {
		var str = $('input[name="size"]').val();
		if (str.length == 2) {
			$('input[name="size"]').val(str.replace(new RegExp(this.value, "g"), ""));
		} else if (str.length > 2) {
			$('input[name="size"]').val(str.replace(new RegExp("," + this.value, "g"), ""));
		}
	}
});

//Список составов
var compositions = {
	wool: {
		ru: "Шерсть",
		eng: "wool",
		current: false,
		amount: 0
	},
	polyester: {
		ru: "Полиэстер",
		eng: "polyester",
		current: false,
		amount: 0
	},
	viscose: {
		ru: "Вискоза",
		eng: "viscose",
		current: false,
		amount: 0
	},
	elastane: {
		ru: "Эластан",
		eng: "elastane",
		current: false,
		amount: 0
	},
	cotton: {
		ru: "Хлопок",
		eng: "cotton",
		current: false,
		amount: 0
	},
	polyamide: {
		ru: "Полиамид",
		eng: "polyamide",
		current: false,
		amount: 0
	},
	nylon: {
		ru: "Нейлон",
		eng: "nylon",
		current: false,
		amount: 0
	},
	lyen: {
		ru: "Лен",
		eng: "lyen",
		current: false,
		amount: 0
	},
	silk: {
		ru: "Шелк",
		eng: "silk",
		current: false,
		amount: 0
	}

	//Проверка уже существующих составов
};function checkComposition() {
	var currentComposition_0 = $('input[name="composition"]').val().split(' ');
	if (currentComposition_0[currentComposition_0.length - 1] == 0) {
		currentComposition_0.pop();
	}
	var currentComposition = [];
	for (var i = 0; i < currentComposition_0.length; i++) {
		currentComposition.push(currentComposition_0[i].split('-'));
	}
	for (var key in compositions) {
		for (var i = 0; i < currentComposition.length; i++) {
			if (compositions[key]["ru"] == currentComposition[i][0]) {
				compositions[key]["current"] = true;
				compositions[key]["amount"] = currentComposition[i][1].split('%')[0];
			}
		}
	}
}

var _createClass = function () {
	function defineProperties(target, props) {
		for (var i = 0; i < props.length; i++) {
			var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);
		}
	}return function (Constructor, protoProps, staticProps) {
		if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;
	};
}();

function _classCallCheck(instance, Constructor) {
	if (!(instance instanceof Constructor)) {
		throw new TypeError("Cannot call a class as a function");
	}
}

//Класс редактирования состава ткани
var editComposition = function () {
	function editComposition(composition, composition_ru, current, amount) {
		_classCallCheck(this, editComposition);

		//Русское название
		this.composition_ru = composition_ru;
		//Английское название
		this.composition = composition;
		//Проверка выбранного состава
		this.composition_current = current;
		//% состава, если выбран
		this.composition_amount = amount;
		//Не выбран - 0, выбран - 1
		if (this.composition_current === true) {
			this.check = 1;
		} else {
			this.check = 0;
		}
		//Необходимо для удаления состава
		if (this.composition_current === true) {
			this.str = this.composition_ru + "-" + this.composition_amount + "%";
		} else {
			this.str = "";
		}
	}
	//Метод добавления импутов

	_createClass(editComposition, [{
		key: "createInput",
		value: function createInput() {
			if (this.composition_current === true) {
				$('#composition_chois').append(this.composition_ru + " <input type=\"checkbox\" value=\"" + this.composition_ru + "\" id=\"composition_chois_" + this.composition + "_cbx\" checked> Количество: <input type=\"text\" id=\"composition_chois_" + this.composition + "_count\" value=\"" + this.composition_amount + "\">% <input type=\"button\" id=\"add_composition_" + this.composition + "\" value=\"Добавить\" onclick=\"" + this.composition + ".add()\"><input type=\"button\" id=\"delete_composition_" + this.composition + "\" onclick=\"" + this.composition + ".delete()\" value=\"Удалить\"><br>");
			} else {
				$('#composition_chois').append(this.composition_ru + " <input type=\"checkbox\" value=\"" + this.composition_ru + "\" id=\"composition_chois_" + this.composition + "_cbx\"> Количество: <input type=\"text\" id=\"composition_chois_" + this.composition + "_count\" value=\"\">% <input type=\"button\" id=\"add_composition_" + this.composition + "\" value=\"Добавить\" onclick=\"" + this.composition + ".add()\"><input type=\"button\" id=\"delete_composition_" + this.composition + "\" onclick=\"" + this.composition + ".delete()\" value=\"Удалить\"><br>");
			}
		}
		//Метод для добавления состава в импут Состава

	}, {
		key: "add",
		value: function add() {
			if ($('#composition_chois_' + this.composition + '_cbx').prop('checked') && this.check == 0) {
				if ($('#composition_chois_' + this.composition + '_count').val().length !== 0) {
					if ($('#composition_chois_' + this.composition + '_count').val() >= 0 && $('#composition_chois_' + this.composition + '_count').val() <= 100) {
						this.str = $('#composition_chois_' + this.composition + '_cbx').val() + "-" + $('#composition_chois_' + this.composition + '_count').val() + "% ";
						$('input[name="composition"]').val($('input[name="composition"]').val() + this.str);
						this.check = 1;
					}
				}
			}
		}
		//Метод удаления состава из импута Состава

	}, {
		key: "delete",
		value: function _delete() {
			if (this.check == 1) {
				var str = $('input[name="composition"]').val();
				$('input[name="composition"]').val(str.replace(this.str, ""));
				this.check = 0;
			}
		}
	}]);

	return editComposition;
}();

checkComposition();
//Цикл создания экземпляров класса editComposition и вызов метода добавления импутов 
for (var key in compositions) {
	window[key] = key;
	window[key] = new editComposition(compositions[key]["eng"], compositions[key]["ru"], compositions[key]["current"], compositions[key]["amount"]);
	window[key].createInput();
}