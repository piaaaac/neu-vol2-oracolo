<?php
$dir = "sounds";
$sounds = glob($dir ."/*.mp3");

$welcomeSentences = [
  "",
  "ask me what you want",
  "",
  "",
  "click to extract a card",
  "and you'll get answers",
  "",
];

$tarocs = [
  ["XVIII",         "",         "le vite passate"],
  ["XVI",           "",         "il fulmine"],
  ["VIII",          "",         "il coraggio"],
  ["V",             "",         "nessuna cosa"],
  ["IV",            "",         "il ribelle"],
  ["XX",            "",         "oltre le illusioni"],
  ["X",             "",         "il mutamento"],
  ["XXI",           "",         "il completamento"],
  ["XIII",          "",         "la trasformazione"],
  ["XVII",          "",         "il silenzio"],
  ["II",            "",         "la voce interiore"],
  ["XIV",           "",         "l'integrazione"],
  [" ",             "",         "il maestro"],
  ["VII",           "",         "la coscienza"],
  ["0",             "",         "il matto"],
  ["IX",            "",         "la solitudine"],
  ["III",           "",         "la creatività"],
  ["XII",           "",         "una nuova visione"],
  ["VI",            "",         "gli amanti"],
  ["XIX",           "",         "l'innocenza"],
  ["I",             "",         "l'esistenza"],
  ["XV",            "",         "il condizionamento"],

  ["fante",         "fuoco",    "divertimento"],
  ["8",             "fuoco",    "in viaggio"],
  ["asso",          "fuoco",    "la fonte"],
  ["re",            "fuoco",    "il creatore"],
  ["regina",        "fuoco",    "condivisione"],
  ["10",            "fuoco",    "repressione"],
  ["cavaliere",     "fuoco",    "intensità"],
  ["5",             "fuoco",    "totalità"],
  ["9",             "fuoco",    "esaurimento"],
  ["4",             "fuoco",    "partecipazione"],
  ["7",             "fuoco",    "stress"],
  ["2",             "fuoco",    "possibilità"],
  ["3",             "fuoco",    "sperimentare"],
  ["6",             "fuoco",    "successo"],
  
  ["9",             "acqua",    "pigrizia"],
  ["4",             "acqua",    "volgersi all'interno"],
  ["8",             "acqua",    "lasciarsi andare"],
  ["re",            "acqua",    "guarigione"],
  ["3",             "acqua",    "celebrazione"],
  ["asso",          "acqua",    "seguire il flusso"],
  ["5",             "acqua",    "aggrapparsi al passato"],
  ["cavaliere",     "acqua",    "fiducia"],
  ["regina",        "acqua",    "ricettività"],
  ["fante",         "acqua",    "comprensione"],
  ["2",             "acqua",    "amichevolezza"],
  ["7",             "acqua",    "proiezioni"],
  ["10",            "acqua",    "armonia"],
  ["6",             "acqua",    "il sogno"],
  
  ["8",             "arcobaleno",  "essere ordinari"],
  ["re",            "arcobaleno",  "abbondanza"],
  ["regina",        "arcobaleno",  "fioritura"],
  ["fante",         "arcobaleno",  "l'avventura"],
  ["3",             "arcobaleno",  "la guida"],
  ["cavaliere",     "arcobaleno",  "rallentare"],
  ["4",             "arcobaleno",  "la miseria"],
  ["6",             "arcobaleno",  "il compromesso"],
  ["7",             "arcobaleno",  "la pazienza"],
  ["9",             "arcobaleno",  "maturità"],
  ["10",            "arcobaleno",  "noi siamo il mondo"],
  ["2",             "arcobaleno",  "momento per momento"],
  ["5",             "arcobaleno",  "l'outsider"],
  ["asso",          "arcobaleno",  "pienezza"],
  
  ["re",            "nuvole",   "controllo"],
  ["fante",         "nuvole",   "la mente"],
  ["10",            "nuvole",   "rinascita"],
  ["asso",          "nuvole",   "consapevolezza"],
  ["4",             "nuvole",   "rimandare"],
  ["cavaliere",     "nuvole",   "lottare"],
  ["6",             "nuvole",   "gravame"],
  ["8",             "nuvole",   "senso di colpa"],
  ["regina",        "nuvole",   "morale"],
  ["2",             "nuvole",   "schizofrenia"],
  ["9",             "nuvole",   "afflizione"],
  ["3",             "nuvole",   "isola-mento"],
  ["7",             "nuvole",   "giochi politici"],
  ["5",             "nuvole",   "confronto"],
];
?>

<!DOCTYPE html>
<html>
<head>
  <title>T • E • C • H • N • O • R • A • C • L • E</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="TECHNORACLE">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> -->
  <style type="text/css">
    
    * { margin: 0; padding: 0; }
    body { background-color: black; }

    @keyframes spin {
      from {transform:rotate(0deg);}
      to {transform:rotate(360deg);}
    }

    #p5-canvas { 
      position: absolute; top: 0; bottom: 0; left: 0; right: 0; 
    }

    #screensize { 
      position: absolute; top: 0; bottom: 0; left: 0; right: 0; 
      display: flex; align-items: center; justify-content: center;
    }
    #rotating-image {
      animation-name: spin;
      animation-duration: 15s;
      animation-iteration-count: infinite;
      animation-timing-function: linear;

      transition: opacity 1s;
      width: 40vh;
    }
    #rotating-image.hide {
      opacity: 0;
    }

  </style>
</head>
<body>
  <div id="p5-canvas"></div>
  <div id="screensize">
    <img id="rotating-image" src="images/uroboro.png">
  </div>
  <script type="text/javascript"></script>
</body>
</html>
<script src="lib/p5-1.3.1/p5.min.js"></script>
<script src="lib/p5-1.3.1/p5.sound.min.js"></script>


<!-- Initial common -->
<script>  
var sounds = <?= json_encode($sounds) ?>;
console.log(sounds);
var welcomeSentences = <?= json_encode($welcomeSentences) ?>;

let track;
let currentFile;
const fadingTime = 2;
let mandala;
let loading = false;
let noiseCount = 0;
let noiseInc = 0.002;
let fadingVolume = false;
// let stopTime;
let skipOne = false;
let fsSmall, fsLarge;
var imgs = [];
var rotation = 0;
var imageIndex = 0;
var randomSeconds;
var currColor, currColorIndex = 0, currCard, currSentence;
var colors;
var fontSerif, fontMono;

function preload() {
  fontSerif = loadFont('fonts/Migra-Regular.otf');
  fontMono = loadFont('fonts/AkkuratMono-Regular.ttf');
}

function setup() {
  // track = loadSound(sounds[fileIndex]);
  // createCanvas(720, 200);
  imgs.push(loadImage("images/above1.jpg"));
  imgs.push(loadImage("images/above2.jpg"));
  var canvas = createCanvas(windowWidth, windowHeight);
  canvas.parent("p5-canvas");
  mandala = new Mandala(60, color(0), color(255));
  currSentence = 0;

  colors = [
    // color(240,255,0, 30),
    // color(0,255,32,  30),
    // color(255,0,235, 30),

    // color(102,0,255, 150),
    color(127,80,199, 150),
    color(0, 30),
    color(0, 30),
    color(0, 30),
  ];

  fsSmall = width/70;
  fsLarge = width/12;
  textAlign(CENTER, CENTER);
  imageMode(CENTER);
  background(0);
}

function draw () {
  var playing = track && track.isPlaying();
  var waiting = !loading && !playing;

  // if (playing) {
  //  if (!fadingVolume && (millis() - 2000 > stopTime)) {
  //     masterVolume(0, fadingTime);
  //    fadingVolume = true;
  //  }
  // }
  // if (millis() > stopTime) {
  //  track.stop();
  // }

  if (waiting) {
    currColor = color(0,0,0, 12);
    mandala.setBg(currColor);
    mandala.setStroke(color(150));
    mandala.setSymmetry(60);

    // v1
    // var n1 = noise(noiseCount);
    // var n2 = noise(noiseCount + 20);
    // var _x = map(n1, 0,1, 0,width);
    // var _y = map(n2, 0,1, 0,height);
    
    // v2
    var speedFactor = 4;
    
    // var _x = width/2 + (frameCount % (width/2/speedFactor) * speedFactor);
    var _x = frameCount % (width/speedFactor) * speedFactor;
    _x = _x < width/2
      ? width - _x
      : _x;
    _x = easeInOutQuad(map(_x, 0,width, 0,1)) * width;

    var n1 = noise(noiseCount*20);
    var noiseInfluence = map(n1, 0,1, -15,150);
    var _y = height/2 + noiseInfluence;

    // rotation += 0.10;
    // if (rotation > 360) rotation = 0;
    // push();
    // translate(width/2, height/2);
    // rotate(rotation);
    // tint(255, 10);
    // image(imgs[imageIndex], width/2,height/2, width*4,height*4);
    // pop();

    noStroke();
    fill(255);
    textSize(fsSmall);
    textFont(fontMono);
    text(welcomeSentences[currSentence], width/2, height - fsSmall*2);

    select("#rotating-image").removeClass("hide");

  } else {
    if (playing) {
      currColor = color(0,0,0, 10);
      mandala.setBg(currColor);
      mandala.setStroke(color(255));
      mandala.setSymmetry(2);

      fill(255, 100);
      noStroke();
      var seconds = (randomSeconds % 60) +"";
      var secondsText = seconds.length === 1 ? "0"+ seconds : seconds;
      var timeText = round(randomSeconds / 60) +":"+ secondsText;
      var soundText = currentFile.substring("sounds/".length, currentFile.length-4) +" — "+ timeText;
      
      textSize(fsLarge);
      textFont(fontSerif);
      text(cardText(currCard), width/2, height/2 - fsLarge*0.3);
      textSize(fsSmall);
      textFont(fontMono);
      text(soundText, width/2, height - fsSmall*2);

      select("#rotating-image").addClass("hide");
    } else {
      // mandala.setBg(color(0,255,142, 8));
      // mandala.setBg(color(0,0,255, 8));
      
      var framseColorChange = 20;
      if (frameCount % framseColorChange === 0) {
        currColorIndex++;
        if (currColorIndex >= colors.length) {
          currColorIndex = 0;
        }
      }
      var c = lerpColor(currColor, colors[currColorIndex], frameCount % framseColorChange / framseColorChange);
      mandala.setBg(c);

      mandala.setStroke(color(255));
      mandala.setSymmetry(6);

      select("#rotating-image").removeClass("hide");
    }
    var speedFactor = 9;
    var _x = width/2 + (frameCount % (width/2/speedFactor) * speedFactor);
    var n1 = noise(noiseCount*20);
    var noiseInfluence = map(n1, 0,1, -50,50);
    var _y = height/2 + noiseInfluence;

  }

  mandala.draw(_x, _y);

  // increase things
  noiseCount += noiseInc;
  if (frameCount % 100 === 0) {
    imageIndex++;
    if (imageIndex >= imgs.length) imageIndex = 0;
  }
  if (frameCount % 200 === 0) {
    currSentence++;
    if (currSentence >= welcomeSentences.length) currSentence = 0;
  }
}

function mousePressed() {
  if (track && track.isPlaying()) {
    track.pause(fadingTime);
    masterVolume(0, fadingTime);
    // background(255, 0, 0);
    return;
  }

  var fileIndex = Math.floor(Math.random() * sounds.length);

  if (currentFile === sounds[fileIndex]) { // same file already loaded

  }

  currentFile = sounds[fileIndex];
  currCard = randomCard();
  console.log("currentFile", currentFile);
  loadSound(currentFile, 
    
    // successCallback
    function (sound) { 
      loading = false;
      console.log("success", sound);
      track = sound;
      var length = 30;
      var duration = sound.duration();
      randomSeconds = round(random() * (duration-length));
      track.play();
      masterVolume(0);
      masterVolume(1, fadingTime);
      track.jump(randomSeconds, length);
      // track.jump(randomSeconds);
      // stopTime = millis() + length*1000;
    },
    
    // errorCallback
    function (e) {
      console.log("error"/*, e*/);
    },
    
    // whileLoading
    function (e) {
      console.log("while"/*, e*/);
      loading = true;
    },
  )
}



// ---------------------------------------------------------------------------
// Mandala class
// ---------------------------------------------------------------------------

function Mandala (symmetry, bgColor, strokeColor) {
  
  this.symmetry = symmetry;
  this.bgColor = bgColor;
  this.strokeColor = strokeColor;
  this.mx = 0;
  this.my = 0;
  this.pmx = 0;
  this.pmy = 0;
  angleMode(DEGREES);

  this.setStroke = function (color) { this.strokeColor = color; }
  this.setBg = function (color) { this.bgColor = color; }
  this.setSymmetry = function (symmetry) { this.symmetry = symmetry; }

  this.draw = function (_x, _y) {
    var angle = 360 / this.symmetry;
    translate(width / 2, height / 2);

    if (_x > 0 && _x < width && _y > 0 && _y < height) {
      this.pmx = this.mx;
      this.pmy = this.my;
      this.mx = _x - width / 2;
      this.my = _y - height / 2;
      
      if (skipOne) {
        skipOne = false;
      } else {
        noStroke();
        fill(this.bgColor, 20);
        rect(-width/2,-height/2, width, height);
        noFill();
        stroke(this.strokeColor);
        strokeWeight(1);
        for (let i = 0; i < this.symmetry; i++) {
          rotate(angle);
          line(this.mx, this.my, this.pmx, this.pmy);
          push();
          scale(1, -1);
          line(this.mx, this.my, this.pmx, this.pmy);
          pop();
        }
      }
    }
  }

}

// ---------------------------------------------------------------------------
// Utilities
// ---------------------------------------------------------------------------

function randomCard () {
  var tarocs = <?= json_encode($tarocs) ?>;
  var card = tarocs[Math.floor(Math.random() * tarocs.length)];
  return card;
}

function cardText (card) {
  var isArcano = card[1] === "";
  var line1 = isArcano ? card[0] : card[0] +" di "+ card[1];
  var line2 = card[2];
  return line1 +"\n\n"+ line2;
}

function easeInOutCubic (x) {
  return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2;
}

function easeInOutQuad (x) {
  return x < 0.5 ? 2 * x * x : 1 - Math.pow(-2 * x + 2, 2) / 2;
}

function easeInOutSine (x) {
  return -(Math.cos(Math.PI * x) - 1) / 2;
}

function easeInOutBack (x) {
  const c1 = 1.70158;
  const c2 = c1 * 1.525;
  return x < 0.5
    ? (Math.pow(2 * x, 2) * ((c2 + 1) * 2 * x - c2)) / 2
    : (Math.pow(2 * x - 2, 2) * ((c2 + 1) * (x * 2 - 2) + c2) + 2) / 2;
}

function easeInCubic (x) {
  return x * x * x;
}

</script>


