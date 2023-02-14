<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/slider.css">
    <title>Slider</title>
</head>
<body>
    <div class="wrapper">
        <div class="block one">
            <div class="block__item">
                <div class="block__title">Заголовок №1</div>
                <div class="block__text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, aspernatur. Quam distinctio, maxime sequi nisi, unde ratione fugiat placeat eligendi assumenda, maiores nesciunt ut. Dolorem libero eaque sit esse magnam?
                </div>
            </div>
            <div class="block__item">
                <div class="block__title">Заголовок №2</div>
                <div class="block__text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, aspernatur. Quam distinctio, maxime sequi nisi, unde ratione fugiat placeat eligendi assumenda, maiores nesciunt ut. Dolorem libero eaque sit esse magnam?
                </div>
            </div>
            <div class="block__item">
                <div class="block__title">Заголовок №3</div>
                <div class="block__text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, aspernatur. Quam distinctio, maxime sequi nisi, unde ratione fugiat placeat eligendi assumenda, maiores nesciunt ut. Dolorem libero eaque sit esse magnam?
                </div>
            </div>
        </div>

    </div>
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.block__title').click(function(event){
                if($('.block').hasClass('one')){
                    $('.block__title').not($(this)).removeClass('active');
                    $('.block__text').not($(this).next()).slideUp(300);
                }
                $(this).toggleClass('active').next().slideToggle(300);
            });
        });
    </script>
</body>
</html>