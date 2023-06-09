"use strict";

window.addEventListener('resize', function () {
  addRequiredClass();
});

function addRequiredClass() {
  if (window.innerWidth < 860) {
    document.body.classList.add('mobile');
  } else {
    document.body.classList.remove('mobile');
  }
}

window.onload = addRequiredClass;
var hamburger = document.querySelector('.hamburger');
var mobileNav = document.querySelector('.nav-list');
var bars = document.querySelectorAll('.hamburger span');
var isActive = false;
hamburger.addEventListener('click', function () {
  mobileNav.classList.toggle('open');

  if (!isActive) {
    bars[0].style.transform = 'rotate(45deg)';
    bars[1].style.opacity = '0';
    bars[2].style.transform = 'rotate(-45deg)';
    isActive = true;
  } else {
    bars[0].style.transform = 'rotate(0deg)';
    bars[1].style.opacity = '1';
    bars[2].style.transform = 'rotate(0deg)';
    isActive = false;
  }
});