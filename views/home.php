<?php require 'config.php'; ?>

<div class="card">
    <div class="row">
        <div id="btnregister">
            Registrar
        </div>

        <a href=<?php echo BASE_URL."logof"; ?>>Sair</a>
    </div>

    <br>
    <table border="1">
        <thead>
            <tr>
                <th>Dia</th> <th>Entrada</th> <th>Saída</th> <th>Entrada</th> <th>Saída</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
                $p = new Ponto();
                $sqlResponse = $p->getPonto($_SESSION['id']);

                if($sqlResponse->rowCount() > 0) {
                    foreach(array_reverse($sqlResponse->fetchAll()) as $value): ?>                
                        <tr>
                            <td><?php echo $value['date']; ?></td>
                            <td><?php echo $value['hrs_entrada_mat']; ?></td>
                            <td><?php echo $value['hrs_saida_mat'] != "" ? $value['hrs_saida_mat'] : " -- : -- : -- "; ?></td>
                            <td><?php echo $value['hrs_entrada_vesp'] != "" ? $value['hrs_entrada_vesp'] : " -- : -- : -- "; ?></td>
                            <td><?php echo $value['hrs_saida_vesp'] != "" ? $value['hrs_saida_vesp'] : " -- : -- : -- "; ?></td>
                        </tr>
            <?php 
                    endforeach;
                } else {
                    echo "<tr>
                            <td> -- : -- : -- </td>
                            <td> -- : -- : -- </td>
                            <td> -- : -- : -- </td>
                            <td> -- : -- : -- </td>
                            <td> -- : -- : -- </td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</div>
<script>
    function registrar() {
        let req = new XMLHttpRequest();
        let msg = '\nNão foi possível efetuar a comunicação com o servidor, por favor entrar em contato com o Adm: Luan Rafael Barbacovi Berto, tel: (66) 9.9652-8894, email: luanrafaelberto@gmail.com e informar a situação!';
        
        req.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                regHora(req.responseText);
            } 
            if(this.readyState == 4 && this.status != 200) {
                alert(msg);
            }           
        }

        req.open('GET', 'http://luandevweb.com/Sistema%20Ponto/hora.php');
        req.send(); 
    }

    function regHora(e) {
        window.location.href = <?php echo '"'.BASE_URL.'index.php?url=home/register/"'; ?> + e;
    }

    var btnregister = document.querySelector('#btnregister');
    btnregister.addEventListener('click', registrar);
</script>