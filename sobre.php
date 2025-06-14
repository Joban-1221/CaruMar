<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre o Projeto</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --background-color: #f8f9fa;
            --text-color: #333;
            --light-gray: #e9ecef;
            --border-radius: 6px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h1, h2, h3 {
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 1rem;
        }

        h2 {
            font-size: 1.5rem;
            margin-top: 2rem;
            border-left: 4px solid var(--primary-color);
            padding-left: 0.5rem;
        }

        h3 {
            font-size: 1.2rem;
            margin-top: 1.5rem;
        }

        p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .team-member {
            background: var(--light-gray);
            padding: 1.2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .team-member h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .team-member p {
            font-size: 0.9rem;
        }

        .btn-voltar {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            margin-top: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .btn-voltar:hover {
            background-color: var(--secondary-color);
        }

        .references {
            background: var(--light-gray);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            margin-top: 2rem;
        }

        .references ul {
            list-style-position: inside;
            margin-top: 0.5rem;
        }

        .references li {
            margin-bottom: 0.5rem;
        }

        .acknowledgment {
            background-color: #f0f7ff;
            padding: 1.5rem;
            border-left: 4px solid var(--primary-color);
            margin: 2rem 0;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .team-grid {
                grid-template-columns: 1fr;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sobre o Projeto</h1>
        
        <section id="projeto">
            <h2>O Catálogo de Espécies Aquáticas</h2>
            <p>Este projeto foi desenvolvido como trabalho da feira de ecologia, ECO III, do IEMA Pleno Carutapera, com o objetivo de catalogar e organizar informações sobre diversas espécies aquáticas encontradas em nossa região.</p>
            <p>O sistema permite o cadastro, edição e visualização de espécies, incluindo informações como nome popular, nome científico, características físicas, habitat, estado de conservação e outras informações relevantes para pesquisadores e entusiastas da vida aquática.</p>
        </section>
        
        <section id="equipe">
            <h2>Nossa Equipe</h2>
            <div class="team-grid">
                <div class="team-member">
                    <h4>Jovan Louzeiro</h4>
                    <p>“Is it better to speak or to die?” - Call Me By Your Name</p>
                </div>
                
                <div class="team-member">
                    <h4>Klyssia Kamille</h4>
                    <p>“Um coração pesa 250g e uma rosa pesa 2g. Você está disposto a trocar um coração por 100 rosas ou 100 rosas por um coração”</p>
                </div>
                
                <div class="team-member">
                    <h4>Nathally Sousa</h4>
                    <p>“Já que sou, o jeito é ser.”</p>
                </div>
                
                <div class="team-member">
                    <h4>Jamilly Ferreira</h4>
                    <p>“Catalogar é cuidar do presente e construir o futuro.”</p>
                </div>
                
                <div class="team-member">
                    <h4>Fabrícia Fernandes</h4>
                    <p>“Não espere por oportunidades. Crie-as.”</p>
                </div>
                
                <div class="team-member">
                    <h4>Kerllon Augusto</h4>
                    <p>“Em cada dado coletado, uma semente de conhecimento é plantada.”</p>
                </div>
                
                <div class="team-member">
                    <h4>Adriele Cristina</h4>
                    <p>“Transformando cada passo em poesia”</p>
                </div>
                
                <div class="team-member">
                    <h4>Geise Ribeiro</h4>
                    <p>“Cada passo conta, mesmo os mais lentos.”</p>
                </div>
                
                <div class="team-member">
                    <h4>Maria Clara</h4>
                    <p>“Acredite em si mesmo e você será invencível.”</p>
                </div>
                
                <div class="team-member">
                    <h4>Rayane</h4>
                    <p>“Na simplicidade de um gesto, mora a grandeza de uma mudança.”</p>
                </div>
            </div>
        </section>
        
        <section id="agradecimentos">
            <h2>Agradecimentos Especiais</h2>
            <div class="acknowledgment">
                <p>Gostaríamos de expressar nosso profundo agradecimento à professora <strong>Lucieda Ferreira dos Remédios</strong>, cujo trabalho acadêmico e pesquisa foram fundamentais para o desenvolvimento deste projeto.</p>
                <p>O PDF "<em><a href="CATALOGO.pdf" target="_blank">CATÁLOGO MERO MAR: projeto ecológico de catalogação de espécies marinhas do município de Carutapera-MA.</a></em>" foi nossa principal fonte de pesquisa e referência, fornecendo informações valiosas e insights que enriqueceram significativamente nosso catálogo de espécies aquáticas.</p>
                <p>Seu compromisso com a pesquisa e educação inspirou nossa equipe a buscar excelência em nosso trabalho.</p>
            </div>
        </section>
        
        <section id="referencias">
            <h2>Referências Bibliográficas</h2>
            <div class="references">
                <ul>
                    <li><strong>DOS REMÉDIOS, Lucieda Ferreira dos Remédios.</strong> CATÁLOGO MERO MAR: <em>projeto ecológico de catalogação de espécies marinhas do município de Carutapera-MA.</em> Carutapera–MA: Centro de Ensino Dr. Tarquínio Lopes Filho; <strong>Secretaria de Estado da Educação do Maranhão, 2021.</strong></li>
                </ul>
            </div>
        </section>
        
        <a href="./" class="btn-voltar">Voltar ao Catálogo</a>
    </div>
</body>

</html>