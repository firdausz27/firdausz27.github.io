<style>
    .tabs{
        position: relative;
        margin: 0 0 0 0;
        width: 750px;
    }
    .tabs input{
        position: absolute;
        z-index: 1000;
        width: 120px;
        height: 40px;
        left: 0px;
        top: 0px;
        opacity: 0;
        cursor: pointer;
    }
    
    .tabs input#tab-2{
        left: 120px;
    }
    .tabs label{
        background: #5ba4a4;
        background: -webkit-linear-gradient(top,#00ADA7,#018984);
        font-size: 12px;
        line-height: 40px;
        position: relative;
        padding: 0 20px;
        float: left;
        display: block;
        width: 90px;
        color: #385c56;
        text-transform: uppercase;
        font-weight: bold;
        text-align: center;
        text-shadow: 1px 1px 1px rgba(255,255,255, 0.3);
        border-radius: 3px 3px 0 0;
        box-shadow: 2px 0 2px rgba(0,0,0,0.1),-2px 0 2px rgba(0,0,0,0.1);
    }
    
    .tabs label:after{
        content: '';
        background: #fff;
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        display: block;
    }
    
    .tabs input:hover+label{
        background: #5ba4a4;
    }
    .tabs label:first-of-type{
        z-index: 4;
        box-shadow: 2px 0 2px rgba(0,0,0,0.1),0 0 2px rgba(0,0,0,0.4);
    }
    
    .tab-label-2{
        z-index: 3;
    }
    
    .tabs input:checked+label{
        background: #fff;
        z-index: 6;
    }
    .clear-shadow{
        clear: both;
    }
    
    .content{
        background: #fff;
        position: relative;
        width: 320px;
        height: 150px;
        z-index: 5;
        box-shadow: 0 -2px 3px rgba(0,0,0,0.3),0 2px 2px rgba(0,0,0,0.4);
        border-radius: 0 3px 3px 3px;
    }
    
    .content div{
        position: absolute;
        top: 0;
        left: 0;
        padding: 0;
        z-index: 1;
        opacity: 0;
        /*-webkit-transition: opacity linear 0.1s;*/
    }
    
    .tabs input.tab-selector-1:checked~.content.content-1,
    .tabs input.tab-selector-2:checked~.content.content-2{
        z-index: 100;
        opacity: 1;
        -webkit-transition: opacity ease-out 0.2s 0.1s;
    }
</style>
<h4>Berita Favorit</h4>
<div class="box">
    <section class="tabs">
        <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked"/>
        <label for="tab-1" class="tab-label-1">Terpopulaer</label>
        <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2"/>
        <label for="tab-2" class="tab-label-2">Terkomentari</label>
        <div class="clear-shadow"></div>
        <div class="content">
            <div class="content-1">
                <ul>
                    <li><a href="">Perang hacker</a></li>
                </ul>
            </div>
            <div class="content-2">
                <ul>
                    <li><a href="">Samsung tetap takberdamai dengan aple</a></li>
                </ul>
            </div>
        </div>
    </section>
</div>