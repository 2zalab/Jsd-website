<h3 class="text-gray-700 text-3xl font-medium mb-6">Statistiques</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Participants Hackaton -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-users text-2xl text-indigo-600 mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-700">Participants Hackaton</h4>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Lycée</p>
                                    <p class="text-2xl font-bold text-indigo-600">{{ $participantsLycee }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Supérieur</p>
                                    <p class="text-2xl font-bold text-indigo-600">{{ $participantsSuperieur }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Réservations de stands -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-booth-curtain text-2xl text-green-600 mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-700">Réservations de stands</h4>
                            </div>
                            <p class="text-3xl font-bold text-green-600">{{ $nombreReservationsStand }}</p>
                        </div>

                        <!-- Demandes de sponsor -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-handshake text-2xl text-yellow-600 mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-700">Demandes de sponsor</h4>
                            </div>
                            <p class="text-3xl font-bold text-yellow-600">{{ $nombreDemandesSponsor }}</p>
                            <p class="text-sm text-gray-600 mt-2">Structures et Entreprises</p>
                        </div>

                        <!-- Projets soumis -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-project-diagram text-2xl text-purple-600 mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-700">Projets soumis</h4>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Niveau Lycée</p>
                                    <p class="text-2xl font-bold text-purple-600">{{ $projetsLycee }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Niveau Senior</p>
                                    <p class="text-2xl font-bold text-purple-600">{{ $projetsSenior }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Participants concours meilleur programmeur -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-trophy text-2xl text-red-600 mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-700">Concours meilleur programmeur</h4>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Lycée</p>
                                    <p class="text-2xl font-bold text-red-600">{{ $participantsConcoursLycee }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Senior</p>
                                    <p class="text-2xl font-bold text-red-600">{{ $participantsConcoursSenior }}</p>
                                </div>
                            </div>
                        </div>

                         <!-- Demandes de sponsor -->
                         <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-message text-2xl text-pink-600 mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-700"> Inscrits sur le newsletter</h4>
                            </div>
                            <p class="text-3xl font-bold text-pink-600">{{ $nombreNewsletters }}</p>
                            <p class="text-sm text-gray-600 mt-2">Contacts</p>
                        </div>
                    </div>
