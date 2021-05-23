<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pineapple</title>
    <link rel="stylesheet" href="public/style/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
  </head>
  <body>
    <main>
      <section>
          <nav>
              <div class="logo">
                <img class="logo_image" src="public/image/Union.png" alt="logotype">
                <span class="logo_name"><img src="public/image/pineapple.png" alt="logotype"></span>
              </div>
              <ul class="nav_content">
                <li>About</li>
                <li>How it works</li>
                <li>Contact</li>
              </ul>
          </nav>
          <div class="outer_subscribe_block">
            <div class="subscribe_block">
              <article>
                <div class="form_description">
                  <h2>Subscribe to newsletter</h2>
                  <p>Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
                </div>
                <form class="subscribe_form" id="app" method="post">
                  <div class="email_field">
                    <input class="input_field" type="email" name="email" placeholder="Type your email address here..." v-model="email">
                    <button class="input_button" type="submit" name="submit" :disabled="isDisabled">
                        <span class="icon-ic_arrow"></span>
                    </button>
                    <div class="input_error">{{ isEmailValid() }} <? echo $data["error"]; ?></div>
                  </div>
                  <div class="email_checkbox">
                    <label>
                    <input name="terms" type="checkbox" v-model="checkbox">
                    <span class="icon-ic_checkmark"></span>
                  </label>
                  <div class="checkbox_desc">I agree to <a href="#">terms of service</a></div>
                  </div>
                </form>
              </article>
              <hr>
              <footer>
                <div class="social_media">
                  <a href="#" class="facebook-circle">
                    <span class="icon-ic_facebook"></span>
                  </a>
                  <a href="#" class="instagram-circle">
                    <span class="icon-ic_instagram"></span>
                  </a>
                  <a href="#" class="twitter-circle">
                    <span class="icon-ic_twitter"></span>
                  </a>
                  <a href="#" class="youtube-circle">
                    <span class="icon-ic_youtube"></span>
                  </a>
                </div>
              </footer>
            </div>
        </div>

      </section>
      <div class="index_image">
      </div>
    </main>
  </body>
  <script src="public/javascript/script.js"></script>
</html>
