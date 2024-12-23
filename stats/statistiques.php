<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportEvents</title>
    <link rel="stylesheet" href="statstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.html">S'inscrire</a></li>
                <li><a href="../accueil.php">Accueil</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="statistiques">
            <h2>Statistiques</h2>

            <?php
            include 'statssql.php';

            $usercounts = 0;
            $sports = [
                'Football' => 0,
                'Basketball' => 0,
                'Tennis' => 0,
                'Rugby' => 0,
                'Escrime' => 0,
            ];

            foreach ($utilisateurs as $utilisateur):
                $usercounts++;
                $sportName = $utilisateur['nomSport'];
                $sports[$sportName]++;
            endforeach;

            // Calculer l'âge à partir de la date de naissance
            $dateNaissance = new DateTime($anneeMoyenneNaissance);
            $aujourdhui = new DateTime();
            $moyenneAge = $aujourdhui->diff($dateNaissance)->y;
            ?>

            <h3>Nombre de personnes inscrites sur le site : <?php echo htmlspecialchars($usercounts); ?> personnes</h3>
            <h3>Moyenne d'âge des personnes inscrites : <?php echo htmlspecialchars($moyenneAge); ?> ans</h3>

            <div class="chart-container">
                <canvas id="sportsPieChart"></canvas>
            </div>

        </section>
    </main>

    <script>
        const ctx = document.getElementById('sportsPieChart').getContext('2d');
        
        const sports = {
            'Football': <?php echo $sports['Football']; ?>,
            'Basketball': <?php echo $sports['Basketball']; ?>,
            'Tennis': <?php echo $sports['Tennis']; ?>,
            'Rugby': <?php echo $sports['Rugby']; ?>,
            'Escrime': <?php echo $sports['Escrime']; ?>
        };

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(sports),
                datasets: [{
                    data: Object.values(sports),
                    backgroundColor: [
                        '#3498db', // Bleu pour Football
                        '#2ecc71', // Vert pour Basketball
                        '#e74c3c', // Rouge pour Tennis
                        '#f39c12', // Orange pour Rugby
                        '#9b59b6'  // Violet pour Escrime
                    ],
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.parsed;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        },
                        bodyFont: {
                            size: 14
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>