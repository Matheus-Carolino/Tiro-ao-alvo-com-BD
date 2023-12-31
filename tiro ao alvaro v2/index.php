<?php
    require_once "model/partida.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeInfo</title>
    <link rel="icon" type="image/png" href="public/img/cursor.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-blue-200">
    <style>
        .jogo{
            cursor: url(img/cursor.png), pointer;
        }

        #ranking{
            animation: fade-in 1s;
        }

        @keyframes fade-in {
            from{
                transform: translateY(-20px);
                opacity: 0;
            }
            to{
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    <nav class="flex bg-blue-950 p-2 shadow-lg">
        <button class="text-amber-300 flex items-center font-bold text-lg bg-blue-800 px-4 rounded-md hover:bg-blue-500" id="btn-ranking"><img src="public/img/ranking.png" alt="" class="w-8 me-2"> Ranking</button>
        <div class="flex justify-center w-10/12">
            <img src="https://logodownload.org/wp-content/uploads/2017/08/pokemon-logo-8.png" alt="logo" class="w-32">
        </div>
    </nav>

    <main class="flex">
        <aside class="hidden z-30 w-full h-full absolute" id="ranking">
            <div class="bg-blue-800 mx-auto w-3/4 md:w-1/3 p-4 rounded-md drop-shadow-md">
                <div class="flex space-x-2">
                    <img src="public/img/ranking.png" alt="" class="w-8">
                    <h1 class="text-amber-300 text-xl border-b border-amber-300 flex-grow">Rank da Região</h1>
                </div>
                <div class="mt-8">
                    <table class="w-full">
                        <tr class="text-white">
                            <th>#</th>
                            <th>nome</th>
                            <th>acertos</th>
                            <th>erros</th>
                            <th>data/hora</th>
                        </tr>
                        <?php
                            $partida = new Partida();
                            $ListaPartidas = $partida->list();
                            $i = 0;
                            foreach($ListaPartidas as $p):
                                $i++;
                                echo "<tr class='text-white text-center'>";
                                if($i == 1){
                                    echo "<td><img src='/public/img/medalhas/gold.png'></td>";
                                }
                                elseif($i == 2){
                                    echo "<td><img src='/public/img/medalhas/prata.png'></td>";
                                }
                                elseif($i == 3){
                                    echo "<td><img src='/public/img/medalhas/bronze.png'></td>";
                                }
                                else{
                                    echo "<td>$i</td>";
                                }
                        ?>
                            <td><?=$p->jogador?></td>
                            <td><?=is_null($p->acertos)?'0':$p->acertos?></td>
                            <td><?=is_null($p->erros)?'0':$p->erros?></td>
                            <td><?=$p->data_hora?></td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </table>

                </div>
            </div>
        </aside>
        
        <article class="mt-4"> 
            <section class="h-96 rounded-md bg-blue-950 shadow-lg px-4 py-16 sm:p-16 relative overflow-hidden mx-4">
                <div class="flex lg:justify-start justify-center space-x-2">
                    <div>
                        <img src="public/img/aviso.png" alt="">
                    </div>
                    <div class="w-3/4 sm:w-1/3 text-justify mx-auto text-white">
                        <p class="text-2xl text-amber-300 my-4 border-b border-amber-300">Atenção, para as regras!</p>
                        <p><b class="text-amber-300 text-base">Um pokemon selvagem apareceu!</b>, para capturá-lo, use uma das suas <b class="text-amber-300"> pokebolas</b>. Mas cuidado, ele pode escapar. Eae? você está pronto, para se tornar um <b class="text-amber-300">Mestre Pokemon</b>! 
                        Você tem <b class="text-amber-300">2 minutos</b> para capturar o máximo de pokemons. Ao final podera ver sua colocação no rank da região.</p>
                    </div>
                </div>
                <div class="lg:block hidden">
                    <img src="https://2.bp.blogspot.com/-wU_tIbVUhj8/VJblpaQIuhI/AAAAAAAANPI/ITT7yi2NWUk/s1600/Nacrene.png" alt="" class="h-96 w-2/4 absolute top-0 inset-x-2/4">
                    <img src="public/img/professor.webp" alt="" class="absolute top-10 inset-x-2/4">
                </div>
            </section>

            <section class="relative overflow-hidden bg-gradient-to-t from-green-400 to-blue-200 pb-10">
                <div class="text-center text-2xl font-bold mt-10">
                    <p>Capture Pokemons para seu time!</p>
                </div>
                <div class="p-2 md:w-3/4 mx-auto flex justify-between items-center">
                    <p class="text-lg text-zinc-600">pokemons Capturados: <b class="text-red-700" id="pontos">0</b></p>
                    <p class="text-lg text-zinc-600">pokemons Perdidos: <b class="text-red-700" id="erros-pontos">0</b></p>
                </div>
                <div class="py-2 flex justify-center relative jogo">
                    <img src="public/img/cenario.jpg" alt="" id="cenario" class="z-10 lg:w-3/4 blur-sm">
                    <div id="blur-start" class="flex absolute lg:w-5/6 w-full h-full z-30 flex-col justify-center items-center">
                        <div class="bg-gradient-to-b from-blue-950 to-blue-800 p-8 rounded-xl shadow-lg shadow-blue-500/50 text-center">
                            <p class="text-amber-300 text-2xl font-bold mb-6" id="msg-start">Começe sua Jornada!</p>
                            <button id="btn-start" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-800 hover:ring-2 hover:ring-red-700">Pokebola Vai!</button>
                        </div>
                    </div>
                    <div id="user-form" class="flex absolute lg:w-5/6 w-full h-full z-30 flex-col justify-center items-center hidden">
                        <div class="bg-gradient-to-b from-blue-950 to-blue-800 p-8 rounded-xl shadow-lg shadow-blue-500/50 text-center">
                            <p class="text-amber-300 text-2xl font-bold" id="msg-user">Tempo esgotado!!</p>
                            <p class="text-amber-200 text-sm mb-6">Resgistre sua pontuação, ou tente novamente.</p>
                            <form action="ws/cadastrar.php" method="get" class="mb-4">
                                <div class="flex flex-col">
                                    <input type="text" name="jogador" id="jogador" class="block w-full rounded-md border-0 p-2 mb-6 placeholder:text-gray-400 sm:text-sm sm:leading-6" placeholder="Digite seu Username..">
                                    <input type="hidden" name="acertos" id="acertos">
                                    <input type="hidden" name="erros" id="erros">
                                </div>
                                <button type="submit" id="btn-user" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-800 hover:ring-2 hover:ring-red-700">Salvar</button>
                            </form>
                            <a href="" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-800 hover:ring-2 hover:ring-red-700">Tentar novamente</a>
                        </div>
                    </div>
                    <canvas id="area-jogo" class="absolute z-20"></canvas>
                </div>
            </section>
        </article>
    </main>

    <footer>
        <div class="w-full bg-blue-950 p-4">
            <div class="flex justify-center space-x-4 mb-4">
                <p class="text-white text-sm"><b>Ginásio:</b> Programação para Internet</p>
                <p class="text-white text-sm"><b>Líder do Ginásio:</b> Marcelo Junior</p>
            </div>
            <div class="flex justify-center items-center space-x-6">
                <div class="flex flex-col items-center">
                    <img src="public/img/insignias/teste.png" alt="" class="w-8 h-8">
                    <p class="text-white text-sm">Matheus Carolino</p>
                </div>

                <div class="flex flex-col items-center">
                    <img src="public/img/insignias/teste2.png" alt="" class="w-8 h-8">
                    <p class="text-white text-sm">João Antônio</p>
                </div>

                <div class="flex flex-col items-center">
                    <img src="public/img/insignias/teste3.png" alt="" class="w-8 h-8">
                    <p class="text-white text-sm">Diógenes Alejandro</p>
                </div>
            </div>
            <p class="text-white text-center mt-4">©2023 Pokémon. ©1995 - 2023 Nintendo/Creatures Inc./GAME FREAK inc. TM, ®Nintendo.</p>
        </div>
    </footer>

    <script src="public/js/script.js"></script>
</body>
</html>