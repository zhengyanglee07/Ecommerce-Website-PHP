window.addEventListener('load', work);
window.addEventListener('load', work2);

function work() {
    var ml4 = {};
    ml4.opacityIn = [0, 1];
    ml4.scaleIn = [0.2, 1];
    ml4.scaleOut = 3;
    ml4.durationIn = 800;
    ml4.durationOut = 600;
    ml4.delay = 500;

    anime.timeline({loop: true})
        .add({
            targets: '#ml4 .letters-1',
            opacity: ml4.opacityIn,
            scale: ml4.scaleIn,
            duration: ml4.durationIn
        }).add({
        targets: '#ml4 .letters-1',
        opacity: 0,
        scale: ml4.scaleOut,
        duration: ml4.durationOut,
        easing: "easeInExpo",
        delay: ml4.delay
    }).add({
        targets: '#ml4 .letters-2',
        opacity: ml4.opacityIn,
        scale: ml4.scaleIn,
        duration: ml4.durationIn
    }).add({
        targets: '#ml4 .letters-2',
        opacity: 0,
        scale: ml4.scaleOut,
        duration: ml4.durationOut,
        easing: "easeInExpo",
        delay: ml4.delay
    }).add({
        targets: '#ml4 .letters-3',
        opacity: ml4.opacityIn,
        scale: ml4.scaleIn,
        duration: ml4.durationIn
    }).add({
        targets: '#ml4 .letters-3',
        opacity: 0,
        scale: ml4.scaleOut,
        duration: ml4.durationOut,
        easing: "easeInExpo",
        delay: ml4.delay
    }).add({
        targets: '#ml4',
        opacity: 0,
        duration: 500,
        delay: 500
    });
}

function work2() {

    anime.timeline({loop: true})
        .add({
            targets: '.ml5 .line',
            opacity: [0.5, 1],
            scaleX: [0, 1],
            easing: "easeInOutExpo",
            duration: 700
        }).add({
        targets: '.ml5 .line',
        duration: 600,
        easing: "easeOutExpo",
        translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
    }).add({
        targets: '.ml5 .ampersand',
        opacity: [0, 1],
        scaleY: [0.5, 1],
        easing: "easeOutExpo",
        duration: 600,
        offset: '-=600'
    }).add({
        targets: '.ml5 .letters-left',
        opacity: [0, 1],
        translateX: ["0.5em", 0],
        easing: "easeOutExpo",
        duration: 600,
        offset: '-=300'
    }).add({
        targets: '.ml5 .letters-right',
        opacity: [0, 1],
        translateX: ["-0.5em", 0],
        easing: "easeOutExpo",
        duration: 600,
        offset: '-=600'
    }).add({
        targets: '.ml5',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });
}


$(document).ready(function () {
    activeTab('tab1');
});

function activeTab(tab){
    $('.nav-tabs a[href=""#' + tab + '"]').tab('show');
}

