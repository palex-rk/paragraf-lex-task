<?php 
    require_once "partials/header.php";
    require_once "queries.php";
?>


<?php 
    $insurances = getData();
    // echo "<pre>";print_r($insurances);die;
?>

<div class="container">

<h3 class="h3 m-5 ">Lista Osiguraonika</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"> # </th>
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Email</th>
                <th scope="col">Broj Pasosa</th>
                <th scope="col">Broj Telefona</th>
                <th scope="col">OD</th>
                <th scope="col">DO</th>
                <th scope="cole">Broj Dana</th>
                <th scope="col">Tip Osiguranja</th>
                <th scope="col">Clanovi Osiguranja</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($insurances as $insurance): ?>
                <tr  scope="row">
                    <td><?php echo $insurance['id']; ?></td>
                    <td><?php echo $insurance['first_name']; ?></td>
                    <td><?php echo $insurance['last_name']; ?></td>
                    <td><?php echo $insurance['email']; ?></td>
                    <td><?php echo $insurance['passport_number']; ?></td>
                    <td><?php echo $insurance['phone_number']; ?></td>
                    <td class="w-100 text-nowrap"><?php $date_start = new DateTime($insurance['travel_date_from']);
                        echo $date_start->format('d F Y'); ?></td>
                    <td class="w-100 text-nowrap"><?php $date_end = new DateTime($insurance['travel_date_to']);
                        echo $date_end->format('d F Y'); ?></td>
                    <td><?php echo $date_start->diff($date_end)->days;?></td>
                    <td><?php echo $insurance['insurance_type']; ?></td>
                    <td>
                        <?php if ($insurance['insurance_type'] == 'grupno'): ?>
                            <div class="accordion accordion-flush" id="accordion-<?php echo $insurance['id']?>">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $insurance['id'] ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Ostali Osiguraonici
                                        </button>
                                    </h2>
                                    <div id="collapse-<?php echo $insurance['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordion-<?php echo $insurance['id']?>">
                                        <div class="accordion-body">
                                            <?php if (!empty($insurance['group_members'])): ?>
                                                <?php foreach ($insurance['group_members'] as $member): ?>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                                </svg>
                                                            </span>

                                                            <?php echo $member['first_name']; ?>
                                                            <span><?php echo $member['last_name']; ?> </span>
                                                            <span><?php echo $member['passport_number']; ?></span>
                                                        </li>
                                                    </ul>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
                
        </tbody>

    </table>

</div>

<?php require_once "partials/footer.php" ?>