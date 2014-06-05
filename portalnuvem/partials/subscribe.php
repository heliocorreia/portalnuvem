<?php

if (isset($_POST['subscribe'])) {
    $fields = array('firstname', 'lastname', 'city', 'state', 'mail', 'site', 'release');
    foreach($fields as $field) {
        $_POST[$field] = stripslashes(trim($_POST[$field]));
    }

    if (!isset($hasError)) {
        $emailTo = get_option('admin_email');
        $subject = "[CADASTRO] $firstname $lastname";
        $body = join("\n", array(
            "Nome: $_POST[firstname] $_POST[lastname]",
            "Origem: $_POST[city] $_POST[state]",
            "Contato: $_POST[mail] $_POST[site]",
            "Release: $_POST[release]"
        ));
        $headers = 'From: '.$firstname.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $_POST['mail'];
        $emailSent = (bool)wp_mail($emailTo, $subject, $body, $headers);
    }
}

?><div class="subscribe">
<form class="subscribe-form" action="<?php the_permalink(); ?>" method="post">
    <h1>Nuvem</h1>
    <p>Você é um artista e quer vender na nuvem produções? Cadastre seus dados e deixe o resto com a gente.</p>
    <fieldset>
        <p>
            <label for="subs-firstname">Nome</label>
            <input type="text" class="subscribe--firstname" id="subs-firstname" name="firstname" value="" />
        </p>
        <p>
            <label for="subs-lastname">Sobrenome</label>
            <input type="text" class="subscribe--lastname" id="subs-lastname" name="lastname" value="" />
        </p>
        <p>
            <label for="subs-city">Cidade</label>
            <input type="text" class="subscribe--city" id="subs-city" name="city" value="" />
        </p>
        <p>
            <label for="subs-state">Estado</label>
            <select id="subs-state" name="state">
                <option>--</option>
                <option>AC</option>
                <option>AL</option>
                <option>AP</option>
                <option>AM</option>
                <option>BA</option>
                <option>CE</option>
                <option>DF</option>
                <option>ES</option>
                <option>GO</option>
                <option>MA</option>
                <option>MT</option>
                <option>MS</option>
                <option>MG</option>
                <option>PA</option>
                <option>PB</option>
                <option>PR</option>
                <option>PE</option>
                <option>PI</option>
                <option>RJ</option>
                <option>RN</option>
                <option>RS</option>
                <option>RO</option>
                <option>RR</option>
                <option>SC</option>
                <option>SP</option>
                <option>SE</option>
                <option>TO</option>
            </select>
        </p>
        <p>
            <label for="subs-mail">E-mail de contato</label>
            <input type="text" class="subscribe--mail" id="subs-mail" name="mail" value="" />
        </p>
        <p>
            <label for="subs-site">Website</label>
            <input type="text" class="subscribe--site" id="subs-site" name="site" value="" />
        </p>
        <p>
            <label for="subs-release">Release</label>
            <textarea class="subscribe--release" id="subs-release" name="release"></textarea>
        </p>
    </fieldset>
    <p>Ao clicar em Cadastrar, você concorda com os <a href="#">termos de uso</a> da Nuvem Produções.</p>
    <p><input name="subscribe" class="input-submit" type="submit" value="Cadastrar" /></p>
</form>
</div>