<style>
    input[type="radio"] {
        display:none;
    }
    label {
        width:23%;
        float:left;
        text-align:center;
        background:#ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        color:#222222;
        padding:0.5%;
        margin:0.5%;
        margin-bottom:30px;
        cursor:pointer;
    }

    input[type="radio"][id="blue"]:checked + label {
        background:#6666ff;
    }
    input[type="radio"][id="blue"]:checked ~ .red, 
    input[type="radio"][id="blue"]:checked ~ .green,
    input[type="radio"][id="blue"]:checked ~ .black{
        width:0;
        height:0;
        padding:0;
        margin:0;
        opacity:0;
    }

    input[type="radio"][id="red"]:checked + label {
        background:#ff4466;
    }
    input[type="radio"][id="red"]:checked ~ .blue, 
    input[type="radio"][id="red"]:checked ~ .green,
    input[type="radio"][id="red"]:checked ~ .black{
        width:0;
        height:0;
        padding:0;
        margin:0;
        opacity:0;
    }

    input[type="radio"][id="green"]:checked + label {
        background:#66dd99;
    }
    input[type="radio"][id="green"]:checked ~ .blue, 
    input[type="radio"][id="green"]:checked ~ .red,
    input[type="radio"][id="green"]:checked ~ .black{
        width:0;
        height:0;
        padding:0;
        margin:0;
        opacity:0;
    }

    input[type="radio"][id="black"]:checked + label {
        background:#000000;
    }
    input[type="radio"][id="black"]:checked ~ .blue, 
    input[type="radio"][id="black"]:checked ~ .red,
    input[type="radio"][id="black"]:checked ~ .green{
        width:0;
        height:0;
        padding:0;
        margin:0;
        opacity:0;
    }

    .tile {
        width:23%;
        height:100px;
        float:left;
        transition:all 1s;
        margin:1.5%;
        padding:1.5%;
    }

    .green {
        background:#66dd99;
    }
    .blue {
        background:#6666ff;
    }
    .red {
        background:#ff4466;
    }
    .black {
        background:#000000;
    }
</style>
<input type="radio" id="blue" name="color" />
<label for="blue">BLUE</label>
<input type="radio" id="red" name="color"/>
<label for="red">RED</label>
<input type="radio" id="green" name="color"/>
<label for="green">GREEN</label>
<input type="radio" id="black" name="color"/>
<label for="black">black</label>

<input type="radio" id="reset" name="color"/>
<label for="reset">RESET</label>
<div class="elements_ggg">

    <div class="tile black">16</div>
    <div class="tile blue">1</div>
    <div class="tile red">2</div>
    <div class="tile blue">3</div>
    <div class="tile green">4</div>
    <div class="tile blue">5</div>
    <div class="tile red">6</div>
    <div class="tile red">7</div>
    <div class="tile green">8</div>
    <div class="tile blue">9</div>
    <div class="tile green">10</div>
    <div class="tile red">11</div>
    <div class="tile black">16</div>
    <div class="tile green">12</div>
    <div class="tile blue">13</div>
    <div class="tile blue">14</div>
    <div class="tile green">15</div>
    <div class="tile red">16</div>
    <div class="tile black">16</div>



</div>

