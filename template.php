<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Shoutbox</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <style>
            #chat-content {
                height: 250px;
                overflow-y: auto;
                background-color: rgba(255,255,255, 0.5);
                margin-bottom: 15px;
                padding: 5px;
                
            }
        </style>
    </head>
    <body>
        <main class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8 jumbotron">
                    <h1 class="h3">Simple Shoutbox</h1>
                    <hr>
                    <div id="chat-content">
                        <?php
                        if (!empty($posts)) {
                            foreach ($posts AS $post) { 
                                echo "<p><strong>#{$post->id} {$post->name}:</strong> {$post->content} <small>[{$post->created_at}]</small></p>";
                            }
                        }
                        ?>
                    </div>
                    <form  class="small">
                        <div class="form-group">
                            <label for="email">Adres e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                          </div>
                        <div class="form-group">
                            <label for="name">Alias</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="example123" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Treść</label>
                            <input type="text" class="form-control" id="content" name="content" placeholder="treść wiadomości..." required>
                        </div>
                        <div class="text-right">
                            <input type="hidden" name="action" value="insert">
                            <input type="button" onClick="send()" value="Wyślij" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                    <p id="status"></p>
                </div>
            </div>
        </main>
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
        <script>
            let lastPostId = <?= !empty($posts) ? end($posts)->id : 0 ?>;
        </script>
        <script src="js/script.js"></script>
        
    </body>
</html>
