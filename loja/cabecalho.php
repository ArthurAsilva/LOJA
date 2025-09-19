<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD lj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Importando a fonte Poppins do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Aplicando a nova fonte para todo o site */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a1029 0%, #1a1f4d 100%);
            color: #e6e6e6;
            padding-top: 20px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Efeito de estrelas cadentes */
        .shooting-star {
            position: fixed;
            top: 0;
            left: 0;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            box-shadow: 0 0 12px 3px rgba(197, 167, 231, 0.8);
            z-index: -1;
            pointer-events: none;
            opacity: 0;
        }
        
        /* Efeito de partículas de fundo */
        .star {
            position: fixed;
            background-color: white;
            border-radius: 50%;
            z-index: -2;
            pointer-events: none;
        }
        
        /* Saturno no background */
        .saturn-background {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle at center, #e2d4f7 0%, #c4a7e7 30%, #8a6dd9 70%);
            box-shadow: 0 0 100px rgba(197, 167, 231, 0.5);
            z-index: -4;
            opacity: 0.15;
        }
        
        .saturn-rings {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(15deg);
            width: 700px;
            height: 100px;
            background: linear-gradient(90deg, transparent, rgba(196, 167, 231, 0.3), transparent);
            border-radius: 50%;
            z-index: -5;
            opacity: 0.2;
            box-shadow: 0 0 50px rgba(196, 167, 231, 0.3);
        }
        
        .navbar {
            margin-bottom: 30px;
            background: rgba(26, 30, 73, 0.85) !important;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(140, 100, 200, 0.4);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(140, 100, 220, 0.3);
        }
        
        .card {
            background: rgba(20, 25, 65, 0.75);
            border: 1px solid rgba(140, 100, 200, 0.35);
            border-radius: 15px;
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 25px rgba(10, 15, 45, 0.5);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(140, 100, 220, 0.4);
        }
        
        .table {
            color: #e6e6e6;
            background: rgba(20, 25, 60, 0.6);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(140, 100, 200, 0.3);
        }
        
        .table th {
            background: rgba(100, 70, 180, 0.7) !important;
            border-color: rgba(180, 150, 230, 0.4);
            color: #e2d4f7 !important;
            font-weight: 600;
            padding: 15px;
        }
        
        .table td {
            border-color: rgba(140, 100, 200, 0.25);
            background: rgba(30, 35, 75, 0.4);
            padding: 15px;
            color: #d8c8f0;
        }
        
        .table tr:hover td {
            background: rgba(120, 90, 190, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #6b48d6, #8a6dd9);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #5a38c5, #795cc8);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(107, 72, 214, 0.4);
        }
        
        .navbar-brand, .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            color: #c4a7e7 !important;
            font-weight: 600;
            font-size: 1.8rem;
            text-shadow: 0 0 15px rgba(196, 167, 231, 0.7);
            display: flex;
            align-items: center;
            margin: 0 auto;
        }
        
        .nav-link {
            color: #bbdefb !important;
            padding: 0.5rem 1.2rem !important;
            border-radius: 8px;
            margin: 0 3px;
        }
        
        .nav-link:hover {
            color: #e2d4f7 !important;
            background: rgba(140, 100, 200, 0.2);
            transform: translateY(-2px);
        }
        
        /* Efeito de aurora boreal sutil no fundo */
        .aurora-effect {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(100, 70, 180, 0.2) 0%, transparent 20%),
                radial-gradient(circle at 90% 30%, rgba(140, 100, 200, 0.15) 0%, transparent 25%),
                radial-gradient(circle at 50% 80%, rgba(80, 50, 160, 0.18) 0%, transparent 30%);
            pointer-events: none;
            z-index: -3;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: #d8c8f0;
            text-shadow: 0 0 10px rgba(196, 167, 231, 0.4);
        }
        
        /* Parágrafos em lilás */
        p, .text-paragraph {
            color: #c4a7e7 !important;
        }
        
        /* Ajustando o container para melhor legibilidade */
        .container {
            max-width: 1200px;
        }
        
        /* Efeito de brilho nos elementos */
        .glow-effect {
            box-shadow: 0 0 15px rgba(196, 167, 231, 0.3);
        }
        
        /* Foguete ao lado do texto */
        .rocket-icon {
            color: #e2d4f7;
            font-size: 1.8rem;
            margin-right: 15px;
            transition: all 0.3s ease;
            text-shadow: 0 0 10px rgba(196, 167, 231, 0.6);
            animation: floatRocket 3s ease-in-out infinite;
        }
        
        @keyframes floatRocket {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-5px) rotate(5deg); }
        }
        
        /* Navbar centralizada */
        .navbar-centered {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Efeito de aurora boreal no plano de fundo -->
    <div class="aurora-effect"></div>
    
    <!-- Saturno no background -->
    <div class="saturn-background"></div>
    <div class="saturn-rings"></div>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <div class="navbar-centered">
                <a class="navbar-brand" href="index.php">
                    <i class="fas fa-rocket rocket-icon"></i>NAVE SW-1
                </a>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <!-- Conteúdo da página aqui -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Criar estrelas cadentes
        function createShootingStar() {
            const star = document.createElement('div');
            star.classList.add('shooting-star');
            
            // Posição inicial aleatória
            const startY = Math.random() * 100;
            star.style.left = '-10px';
            star.style.top = `${startY}vh`;
            
            document.body.appendChild(star);
            
            // Animação da estrela cadente
            const animation = star.animate([
                { 
                    transform: 'translateX(0) translateY(0)',
                    opacity: 0
                },
                { 
                    transform: `translateX(${window.innerWidth + 100}px) translateY(${Math.random() * 100 - 50}px)`,
                    opacity: 1
                }
            ], {
                duration: Math.random() * 2000 + 1000,
                easing: 'linear'
            });
            
            // Remover estrela após a animação
            animation.onfinish = () => {
                star.remove();
            };
        }
        
        // Criar estrelas de fundo
        function createBackgroundStars() {
            const starsCount = 100;
            
            for (let i = 0; i < starsCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                
                const size = Math.random() * 3;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                
                star.style.opacity = Math.random() * 0.7 + 0.3;
                
                document.body.appendChild(star);
                
                // Adicionar efeito de brilho pulsante
                setInterval(() => {
                    star.style.opacity = Math.random() * 0.7 + 0.3;
                }, Math.random() * 2000 + 1000);
            }
        }
        
        // Inicializar estrelas de fundo
        createBackgroundStars();
        
        // Criar estrelas cadentes em intervalos aleatórios
        setInterval(() => {
            createShootingStar();
        }, 1500);
        
        // Criar algumas estrelas iniciais
        for (let i = 0; i < 3; i++) {
            setTimeout(() => {
                createShootingStar();
            }, i * 800);
        }
    </script>
</body>
</html>