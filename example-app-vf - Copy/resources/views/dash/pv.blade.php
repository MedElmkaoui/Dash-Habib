<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pv De jour</title>
    <style>
        body{
            font-family:  -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        .title{
            font-size: 20px; 
            text-align: center;

        }
        .title-box{
            display: block;
            width: 100%;
            text-align: center;
            font-size: 13px;
            margin-bottom: 2rem;

        }

        .info{
            font-size: 13px;
            padding-left: 2rem;
            margin-bottom: 3rem;
        }
        .last-td{
            width: 300px;
        }

        .logo{
            width: 20%;
        }

        .container{
            width: 98%;
            margin: 0 auto;
        }

        .container table{
            width: 100%;
            margin-bottom: 2rem;
        }

        .container table thead{
            background-color: rgb(236, 236, 236)
        }
        .container table thead th{
            text-align: left;
            font-size: 15px;
            font-weight: bold;
            width: 30px;
            border-bottom: 1px solid black;
            padding: 0.5rem 0 0.5rem 1.5rem;
        }
        .container table tbody tr td{
            text-align: left;
            width: 25%;
            font-size: 14px;
            border-bottom: 1px dotted rgb(54, 54, 54);
            padding: 0.5rem 0 0.5rem 1.5rem;
        }
        .container table tfoot tr td{
            text-align: left;
            background-color: rgb(236, 236, 236);
            width: 25%;
            border-bottom: 1px dotted rgb(54, 54, 54);
            padding: 0.5rem 0 0.5rem 1.5rem;
        }
        





    </style>
</head>
<body>
    <img src="{{public_path('\FrontEnd\logo.png')}}" class="logo" alt="">

    <div class="title-box">
        <h1 class="title">Pv D'ARRETER DE CAISSE:</h1>
        <span>{{now()}} </span>
    </div>
    
    <div class="info">
        <p>Chargé de clientèle: {{($caisse==null)? 'Nom et Prénom' : $caisse->user->name}}</p>
        <p>Code Caisse: {{($caisse==null)? 'Nom et Prénom' : $caisse->user->name}}</p>
        <p>Code Agence: {{($caisse==null)? 'Nom et Prénom' : $caisse->user->name}}</p>
    </div>
    

    <div class="container">
        <table>
            <thead>
                <th>Billets</th>
                <th>Nbr</th>
                <th>Caisse | Coffer d'agence</th>
            </thead>
            
            <tbody>
                <tr>
                    <td>200</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_200}}</td>
                    <td  class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 200}}</td>
                </tr>
                <tr>
                    <td>100</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_100}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 100}}</td>
                </tr>
                <tr>
                    <td>50</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_50}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 050}}</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_20}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 20}}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_10}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 10}}</td>
                </tr>
                <tr>
                    <td>05</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_5}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 5}}</td>
                </tr>
                <tr>
                    <td>02</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_2}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 02}}</td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_1}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 1}}</td>
                </tr>
                <tr>
                    <td>0.5</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_05}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 0.5}}</td>
                </tr>
                <tr>
                    <td>0.2</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_04}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 0.2}}</td>
                </tr>
                <tr>
                    <td>0.1</td>
                    <td>{{($caisse==null)? 00 : $caisse->n_02}}</td>
                    <td class="last-td">{{($caisse==null)? 00 : $caisse->n_02 * 0.1}}</td>
                </tr>

                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td  class="last-td">{{($caisse==null)? 00 : $caisse->sold_total}}</td>
                </tr>
            </tfoot>
        </table>

        <table>
            <thead>
                <th>Operation In</th>
                <th>Nomber</th>
                <th>Montant</th>
            </thead>
            <tbody>
                @foreach ($grouped_operations as $op)
                    @if ($op->in_out == "In")
                        <tr>
                            <td>{{$op->name}}</td>
                            <td>{{$op->count}}</td>
                            <td class="last-td">{{$op->total}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <thead>
                <th>Operation Out</th>
                <th>Nomber</th>
                <th>Montant</th>
            </thead>
            <tbody>
                @foreach ($grouped_operations as $op)
                @if ($op->in_out == "Out")
                    <tr>
                        <td>{{$op->name}}</td>
                        <td>{{$op->count}}</td>
                        <td class="last-td">{{$op->total}}</td>
                    </tr>
                @endif
                    
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td>Total</td>
                    <td>{{$sum_count}}</td>
                    <td class="last-td">{{$sum_total }}</td>
                </tr>
            </tfoot>
            
        </table>

        <table>
            <thead>
                <th>Charge</th>
                <th>Agence</th>
                <th>Montant</th>
            </thead>
            <tbody>
                @foreach ($charges as $charge)
                    <tr>
                        <td>{{$charge->label}}</td>
                        <td>{{$charge->agency->code_ag}}</td>
                        <td class="last-td">{{$charge->montant}}</td>
                    </tr>
                @endforeach
            </tbody>
            
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td>{{$sum_count}}</td>
                    <td class="last-td">{{$sum_total }}</td>
                </tr>
            </tfoot>
            <tfoot>
                <tr>
                    <td colspan="2">Sold Départ</td>
                    <td class="last-td">{{ 0.00 }}</td>
                </tr>
            </tfoot>
            <tfoot>
                <tr>
                    <td colspan="2">Sold Final</td>
                    <td class="last-td">{{0.00}}</td>
                </tr>
            </tfoot>
            
        </table>
    </div>
    
</body>
</html>