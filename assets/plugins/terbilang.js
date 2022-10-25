var thoudelim = ".";
  var decdelim = ",";
  var curr = "Rp ";
  var d = document;

  function format(s, r) {
    s = Math.round(s * Math.pow(10, r)) / Math.pow(10, r);
    s = String(s);
    s = s.split(".");
    var l = s[0].length;
    var t = "";
    var c = 0;
    while (l > 0) {
      t = s[0][l - 1] + (c % 3 == 0 && c != 0 ? thoudelim : "") + t;
      l--;
      c++;
    }
    s[1] = s[1] == undefined ? "0" : s[1];
    for (i = s[1].length; i < r; i++) {
      s[1] += "0";
    }
    return curr + t + decdelim + s[1];
  }

  function threedigit(word) {
    eja = Array("Nol", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan");
    while (word.length < 3) word = "0" + word;
    word = word.split("");
    a = word[0];
    b = word[1];
    c = word[2];
    word = "";
    word += (a != "0" ? (a != "1" ? eja[parseInt(a)] : "Se") : "") + (a != "0" ? (a != "1" ? " Ratus" : "ratus") : "");
    word += " " + (b != "0" ? (b != "1" ? eja[parseInt(b)] : "Se") : "") + (b != "0" ? (b != "1" ? " Puluh" : "puluh") :
      "");
    word += " " + (c != "0" ? eja[parseInt(c)] : "");
    word = word.replace(/Sepuluh ([^ ]+)/gi, "$1 Belas");
    word = word.replace(/Satu Belas/gi, "Sebelas");
    word = word.replace(/^[ ]+$/gi, "");

    return word;
  }

  function sayit(s) {
    var thousand = Array("", "Ribu", "Juta", "Milyar", "Trilyun");
    s = Math.round(s * Math.pow(10, 2)) / Math.pow(10, 2);
    s = String(s);
    s = s.split(".");
    var word = s[0];
    var cent = s[1] ? s[1] : "0";
    if (cent.length < 2) cent += "0";

    var subword = "";
    i = 0;
    while (word.length > 3) {
      subdigit = threedigit(word.substr(word.length - 3, 3));
      subword = subdigit + (subdigit != "" ? " " + thousand[i] + " " : "") + subword;
      word = word.substring(0, word.length - 3);
      i++;
    }
    subword = threedigit(word) + " " + thousand[i] + " " + subword;
    subword = subword.replace(/^ +$/gi, "");

    word = (subword == "" ? "NOL" : subword.toUpperCase()) + " RUPIAH";
    subword = threedigit(cent);
    cent = (subword == "" ? "" : " ") + subword.toUpperCase() + (subword == "" ? "" : " SEN");
    return word + cent;
  }
  document.getElementById('terbilang').innerHTML = sayit(43957420764207.10);