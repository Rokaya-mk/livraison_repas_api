
@extends('home')
@section('dash')
    <div class="cards">
        <div class="card-single">
            <div>
                <h1>54</h1>
                <span>Nombres Clients</span>
            </div>
            <div>
                <span class="las la-users"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>54</h1>
                <span>nombres Repas</span>
            </div>
            <div>
                <span><i class="las la-utensils"></i></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>54</h1>
                <span>Nombre de Commandes</span>
            </div>
            <div>
                <span><i class="las la-shopping-bag"></i></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>54</h1>
                <span>Total des Ventes</span>
            </div>
            <div>
                <span ><i class="las la-money-check-alt"></i></span>
            </div>
        </div>

    </div>
    <div class="recent-grid">
        <div class="projects">
            <div class="card">
                <div class="card-header">
                    <h3>Lists Commandes Recentes</h3>
                    <button>Voir tous
                        <span class="las la-arrow-right"></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width=100%>
                            <thead>
                                <tr>
                                    <td>Projet title</td>
                                    <td>Deparetement</td>
                                    <td>status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PHotoshop</td>
                                    <td>UX</td>
                                    <td>
                                        <span class="status purple-circle"></span>
                                        review
                                    </td>
                                </tr>
                                <tr>
                                    <td>PHotoshop</td>
                                    <td>UX</td>
                                    <td>
                                        <span class="status pink"></span>
                                        in progress
                                    </td>
                                </tr>
                                <tr>
                                    <td>PHotoshop</td>
                                    <td>UX</td>
                                    <td>
                                        <span class="status orange"></span>
                                        pending
                                    </td>
                                </tr>
                                <tr>
                                    <td>PHotoshop</td>
                                    <td>UX</td>
                                    <td>
                                        <span class="status purple-circle"></span>
                                        review
                                    </td>
                                </tr>
                                <tr>
                                    <td>PHotoshop</td>
                                    <td>UX</td>
                                    <td>
                                        <span class="status pink"></span>
                                        in progress
                                    </td>
                                </tr>
                                <tr>
                                    <td>PHotoshop</td>
                                    <td>UX</td>
                                    <td>
                                        <span class="status orange"></span>
                                        pending
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
        <div class="customers">
            <div class="card">
                <div class="card-header">
                    <h3>Nouveaux Clients</h3>
                    <button>Voir plus
                        <span class="las la-arrow-right"></span>
                    </button>
                </div>
                <div class="card-body">

                    <div class="customer">
                        <div class="info">
                            <img src="images/162297520672.jpg" width="40px" height="40px" alt="">
                            <div>
                                <h4>Customer1</h4>
                                <small>CEO</small>
                            </div>
                        </div>

                        <div class="contact">
                            <span class="las la-user-circle"></span>
                            <span class="las la-comment"></span>
                            <span class="las la-phone"></span>
                        </div>
                    </div>
                    <div class="customer">
                        <div class="info">
                            <img src="images/162297520672.jpg" width="40px" height="40px" alt="">
                            <div>
                                <h4>Customer1</h4>
                                <small>CEO</small>
                            </div>
                        </div>

                        <div class="contact">
                            <span class="las la-user-circle"></span>
                            <span class="las la-comment"></span>
                            <span class="las la-phone"></span>
                        </div>
                    </div>
                    <div class="customer">
                        <div class="info">
                            <img src="images/162297520672.jpg" width="40px" height="40px" alt="">
                            <div>
                                <h4>Customer1</h4>
                                <small>CEO</small>
                            </div>
                        </div>

                        <div class="contact">
                            <span class="las la-user-circle"></span>
                            <span class="las la-comment"></span>
                            <span class="las la-phone"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @stop





