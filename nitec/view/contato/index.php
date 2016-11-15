

<?php include_once"../template/header.php"; ?>


    <div class="col-md-6">
    <div clas="row">
        <form id="contact-form" method="post" action="#" role="form">

    <div class="messages alert"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Nome *</label>
                    <input id="form_name" type="text" name="name" class="form-control" p required="required" data-error="Firstname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">Sobrenome *</label>
                    <input id="form_lastname" type="text" name="surname" class="form-control"  required="required" data-error="Lastname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control"  required="required" data-error="Valid email is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Telefone</label>
                    <input id="form_phone" type="tel" name="phone" class="form-control" >
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Mensagem *</label>
                    <textarea id="form_message" name="message" class="form-control"  rows="4" required="required" data-error="Please,leave us a message."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send" value="Enviar">
            </div>
        </div>
        
    </div>

</form>
</div>
    </div>
<div class="col-md-6" style="margin-top:40px">
<iframe src="https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d1834.8213892293686!2d-50.361185233534215!3d-23.110169082066015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e6!4m3!3m2!1d-23.1099964!2d-50.3606676!4m0!5e0!3m2!1spt-BR!2sbr!4v1478046515464" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<?php include_once"../template/header.php"; ?>