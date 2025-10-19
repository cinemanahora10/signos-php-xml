<?php 
    include('layouts/header.php'); 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="text-center mb-4">Descubra seu Signo</h1>
                    
                    <form id="signo-form" method="POST" action="show_zodiac_sign.php">
                        
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="data_nascimento" 
                            name="data_nascimento" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Descobrir</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</body> </html>