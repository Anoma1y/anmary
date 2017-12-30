<style>
	*{
  box-sizing: border-box;
}
body{
  background: #656565
}
.page{
  text-align: center;
  display: block;
  position: relative;
  width:80%;
  margin:100px auto;
}
.error{
  font-size: 220px;
  position: relative;
  display: inline-block;
  z-index: 2;
  height: 250px;
  letter-spacing: 15px;
}
.text{
  text-align:center;
  display:block;
  position:relative;
  letter-spacing: 5px;
  font-size: 4em;
  line-height: 80%;
}
.text2{
  text-align:center;
  display:block;
  position: relative;
  font-size: 20px;
}

.btn{
  background-color: rgb( 255, 255, 255 );
  position: relative;
  display: inline-block;
  width: 358px;
  padding: 5px;
  z-index: 5;
  font-size: 25px;
  margin:0 auto;
  color: #e15669;
  text-decoration: none;
  margin-right: 10px;
  margin-top: 20px;
  transition: all .2s ease-in-out;
}
.btn:hover{
	opacity: .8;
	color: black;
}

</style>
<div class='page'>
  <div class='error'>404</div>
  <hr>
  <div class='text'>Запрашиваемая страница</div>
  <div class='text2'>не найдена</div>
  <a class='btn' href='/'>Вернуться на главную</a>
</div>