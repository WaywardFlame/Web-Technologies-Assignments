"use strict";

window.addEventListener('load', function() {
    // get user input
    let num = null;
    while(num === null){
        num = prompt("how many color segments?");
    }

    // create hello world div
    let HelloWorldDiv = this.document.createElement("div");
    HelloWorldDiv.className = "HelloWorld";
    let HelloWorldPara = this.document.createElement("p");
    HelloWorldPara.innerHTML = "Hello, World!";
    HelloWorldPara.id = "hellotext";

    // create buttons div
    let ColorButtonsDiv = this.document.createElement("div");
    ColorButtonsDiv.className = "ColorButtons";
    let count = 0;
    for(let i = 0; i < num; i++){
        let n1 = i / (num-1);
        n1 = Math.round(n1 * 255);
        let colorVal1 = ("00" + n1.toString(16)).slice(-2);
        for(let j = 0; j < num; j++){
            let n2 = j / (num-1);
            n2 = Math.round(n2 * 255);
            let colorVal2 = ("00" + n2.toString(16)).slice(-2);
            for(let k = 0; k < num; k++){
                let n3 = k / (num-1);
                n3 = Math.round(n3 * 255);
                let colorVal3 = ("00" + n3.toString(16)).slice(-2);
                let fullColor = "#" + colorVal1 + colorVal2 + colorVal3;
                console.log("# 1 " + colorVal1 + " 2 " + colorVal2 + " 3 " + colorVal3);

                count++;
                let newButton = this.document.createElement("button");
                newButton.innerHTML = count;
                newButton.style.backgroundColor = fullColor;
                newButton.style.paddingLeft = "10px";
                newButton.style.paddingRight = "10px";
                newButton.style.paddingBottom = "10px";
                newButton.style.paddingTop = "10px";
                newButton.addEventListener("click", function() { ChangeBackgroundColor(newButton.style.backgroundColor) });
                ColorButtonsDiv.appendChild(newButton);
            }
        }
    }

    // add hello world div to html
    HelloWorldDiv.appendChild(HelloWorldPara);
    this.document.body.appendChild(HelloWorldDiv);

    // add buttons div to html
    this.document.body.appendChild(ColorButtonsDiv);
});

function ChangeBackgroundColor(buttonColor){
    let text = document.getElementById("hellotext");
    text.style.backgroundColor = buttonColor;
}