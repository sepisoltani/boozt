<?php require APPROOT . '/views/inc/header.php'; ?>

<?php if (isset($data)): ?>
    <form method="get">
        <label>
            Please insert from date
            <input value="<?php echo isset($_GET['fromDate']) ? $_GET['fromDate'] : $data['fromDate']; ?>"
                   name="fromDate" type="text"
                   class="form-control" placeholder="e.g: 2020-03-10">
        </label>
        <label>
            Please insert to date
            <input value="<?php echo isset($_GET['toDate']) ? $_GET['toDate'] : $data['toDate']; ?>" name="toDate"
                   type="text" class="form-control" placeholder="e.g: 2020-03-10">
        </label>
        <input type="submit" class="btn btn-primary">
    </form>

    <div style="margin-top: 20px;">
        <div class="alert alert-primary" role="alert">
            Total number of orders from <?php echo $data['fromDate']; ?> to <?php echo $data['toDate']; ?> is
            : <b><?php echo $data['numberOfOrders']; ?></b>
        </div>
        <div class="alert alert-secondary" role="alert">
            Total number of revenue from <?php echo $data['fromDate']; ?> to <?php echo $data['toDate']; ?> is
            : <b><?php echo $data['revenue']; ?></b>
        </div>
        <div class="alert alert-success" role="alert">
            Total number of customers from <?php echo $data['fromDate']; ?> to <?php echo $data['toDate']; ?> is
            : <b><?php echo $data['numberOfCustomers']; ?></b>
        </div>
    </div>

    <div id="mychart" data-orders='<?php echo $data['orderChartData']; ?>'
         data-customers='<?php echo $data['customersChartData']; ?>'>
        <canvas id="line-chart"></canvas>
    </div>


<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>