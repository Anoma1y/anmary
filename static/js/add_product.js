"use strict";

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
function createCheckBox() {
	for (var key in sizeName) {
		$('.size_chois').append(sizeName[key]["size"] + '<input type="checkbox" value="' + sizeName[key]["size"] + '" name="size_chois">');
	}
}
createCheckBox();
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

var addComposition = function () {
	function addComposition(composition, composition_ru) {
		_classCallCheck(this, addComposition);

		this.composition_ru = composition_ru;
		this.composition = composition;
		this.check = 0;
		this.str = "";
	}

	_createClass(addComposition, [{
		key: 'createInput',
		value: function createInput() {
			$('#composition_chois').append(this.composition_ru + ' <input type="checkbox" value="' + this.composition_ru + '" id="composition_chois_' + this.composition + '_cbx"> Количество: <input type="text" id="composition_chois_' + this.composition + '_count" value="">% <input type="button" id="add_composition_' + this.composition + '" value="Добавить" onclick="' + this.composition + '.add()"><input type="button" id="delete_composition_' + this.composition + '" onclick="' + this.composition + '.delete()" value="Удалить"><br>');
		}
	}, {
		key: 'add',
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
	}, {
		key: 'delete',
		value: function _delete() {
			if (this.check == 1) {
				var str = $('input[name="composition"]').val();
				$('input[name="composition"]').val(str.replace(this.str, ""));
				this.check = 0;
			}
		}
	}]);

	return addComposition;
}();
var compositions = {
	wool: {
		ru: "Шерсть",
		eng: "wool"
	},
	polyester: {
		ru: "Полиэстер",
		eng: "polyester"
	},
	viscose: {
		ru: "Вискоза",
		eng: "viscose"
	},
	elastane: {
		ru: "Эластан",
		eng: "elastane"
	},
	cotton: {
		ru: "Хлопок",
		eng: "cotton"
	},
	polyamide: {
		ru: "Полиамид",
		eng: "polyamide"
	},
	nylon: {
		ru: "Нейлон",
		eng: "nylon"
	},
	lyen: {
		ru: "Лен",
		eng: "lyen"
	},
	silk: {
		ru: "Шелк",
		eng: "silk"
	}
};
for (key in compositions) {
	window[key] = key;
	window[key] = new addComposition(compositions[key]["eng"], compositions[key]["ru"]);
	window[key].createInput();
}

//Добавление размера
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