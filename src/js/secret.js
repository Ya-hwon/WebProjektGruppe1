function setup() {
  $(document).ready(function(){
  canvas = createCanvas(windowWidth*0.8, windowHeight*0.5);
  canvas.center('horizontal');
  $('footer').css('margin-top',''+(windowHeight*0.6)+'px');
  canvas.canvas.style.display = "none";
  frameRate(60);
  textSize(32);
}
}
function activate(){
  canvas.canvas.style.display = "block";
  restart();
  roundActive=true;
}

var canvas;

var roundActive = false;

var gravity = 0.07;

var mult = 1.0;

var points = 0;

var hits = 0;

class Droplet{
  constructor(x, y, size, speed){
    this.x = x;
    this.y = y;
    this.size = size;
    this.speed = speed;
  }
  draw(){
    fill('blue');
    push();
    translate(this.x,this.y);
    beginShape();
    strokeWeight(1);
    vertex(0,-5);
    quadraticVertex(3*this.size, 0, 0, 1*this.size);
    quadraticVertex(-3*this.size,0, 0, -5*this.size);
    endShape(CLOSE);
    pop();
  }
  update(){
    this.y += this.speed;
    this.speed += gravity;
  }
}
class Player{
  constructor(){
    this.x = 0;
    this.y = 0;
    this.size = 100;
  }
  draw(){
    fill(255);
    arc(this.x, this.y, this.size, this.size, -PI, 0, CHORD);//replace with graphic?
    line(this.x, this.y, this.x, this.y+60);
  }
}
class Person{
  constructor(x, size, lifetime, points){
    this.x = x;
    this.size = size;
    this.y = height-size*2.5;
    this.lifetime = lifetime;
    this.beginlifetime = lifetime;
    this.points = points;
    this.hit = false;
  }
  draw(){
    fill(255);
    circle(this.x, this.y, this.size);//head
    line(this.x, this.y+this.size/2, this.x, this.y+this.size*2);//torso
    line(this.x, this.y+this.size*2, this.x+this.size/3, this.y+this.size*2.5);//right leg
    line(this.x, this.y+this.size*2, this.x-this.size/3, this.y+this.size*2.5);//left leg
    line(this.x, this.y+this.size,this.x+this.size/4, this.y+this.size*1.5);//right arm
    line(this.x, this.y+this.size,this.x-this.size/4, this.y+this.size*1.5);//left arm
    fill(this.hit?'red':'green');
    var val = map(this.lifetime, 0, this.beginlifetime, PI, -PI);
    arc(this.x, this.y, this.size, this.size, -PI, val, PIE);
  }
  update(){
    this.lifetime--;
    if(this.lifetime==0)return true;
    return false;
  }
}
function collision(){
  for (var i = 0; i < droplets.length; i++) {
    if(droplets[i].y+droplets[i].size*2>height){
      mult=1.0;
      points--;
      droplets.splice(i, 1);
      i--;
      continue;
    }
    var a = droplets[i].x - player.x;
    var b = droplets[i].y - player.y;
    var c = Math.sqrt( a*a + b*b );
    if(droplets[i].y<player.y&(c<=(player.size/2+droplets[i].size*2))){
      points+=mult;
      mult+=0.01;
      droplets.splice(i, 1);
      i--;
      continue;
    }
    for(var e = 0; e < ppl.length; e++){
      var a = droplets[i].x - ppl[e].x;
      var b = droplets[i].y - ppl[e].y;
      var c = Math.sqrt( a*a + b*b );
      var tocontinue = false;
      if(c<=droplets[i].size*2+ppl[e].size/2){
        if(ppl[e].hit)gameOver();
        if(hits>5)gravity*1.5;
        hits++;
        points/=2*mult;
        ppl[e].points/=2;
        mult=1.0;
        ppl[e].hit=true;
        droplets.splice(i, 1);
        i--;
        tocontinue=true;
        break;
      }
    }
    if(tocontinue)continue;
  }
}


var player = new Player();
var droplets = new Array();
var ppl = new Array;

function mouseMoved(){
  player.x=mouseX;
  player.y=mouseY;
}
function mouseClicked(){
  restart();
}
function keyPressed(){
  if(keyCode === BACKSPACE){
    console.log("back");
    name=name.slice(0,-1);
  }else if(keyCode === ENTER){
    $('#hiddenInput').val(Math.floor(points)+' '+name);
    $('#hiddenForm').submit();
  }
}
function keyTyped(){
  name=name.concat(key);
}

function draw() {
  background('white');
  if(roundActive){
    if(points<0){
      points=0;
      gameOver();
    }
    if(frameCount%16==0)genDroplet();
    if(frameCount>1000&frameCount%32==0)genDroplet();
    if(frameCount>10000&frameCount%16==0)genDroplet();
    if(frameCount%120==0)genPerson();
    droplets.forEach(d => d.update());
    collision();
    for(var e = 0; e < ppl.length; e++){
      if(ppl[e].update()){
        mult+=0.1;
        points+=ppl[e].points*mult;
        ppl.splice(e, 1);
        e--;
      }
    }
    player.draw();
    droplets.forEach(d => d.draw());
    ppl.forEach(d => d.draw());
    fill('black');
    textAlign(LEFT);
    text((Math.floor(points)+' points, x'+mult), 0, 30);
  }else{
    fill('red');
    textAlign(CENTER);
    text(("GAME OVER\nYour score: "+Math.floor(points)+"\nHighscores:\n"+records+'\nYour name: '+name).replaceAll(',','\n'), width/2, height/4);
  }
}

function genDroplet(){
  droplets.push(new Droplet(random(0, width), -10, random(1,3), 1));
}
function genPerson(){
  ppl.push(new Person(random(0, width), random(20, 40), Math.floor(random(300, 10000)), random(10, 200)));
}

function gameOver(){
  roundActive=false;
  //TODO
}

function restart(){
  points=0;
  mult = 1.0;
  gravity = 0.07;
  hits = 0;
  player = new Player();
  droplets = new Array();
  ppl = new Array;
  roundActive=true;
}
