<?php
$month = !empty($_SESSION['userId']) ? "premium&q=month" : "signUp&goPrem=true&q=month";
$year = !empty($_SESSION['userId']) ? "premium&q=year" : "signUp&goPrem=true&q=year";

?>
<div id="thirdSection">
    <div class="background">
        <div class="container">
            <div class="panel pricing-table">
                <table>
                    <tr class="toBeHidden">
                        <td>
                            <img src="./public/images/premium/ball.png" alt="a ball" class="pricing-img">
                        </td>
                        <td><img src="./public/images/premium/trekking-man.png" alt="a walker" class="pricing-img"></td>
                        <td><img src="./public/images/premium/bicyclist.png" alt="a bike" class="pricing-img"></td>
                        <td><img src="./public/images/premium/basejump.png" alt="a bob" class="pricing-img"></td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="pricing-header">Features</h2>
                        </td>
                        <td>
                            <h2 class="pricing-header">Basic</h2>
                        </td>
                        <td>
                            <h2 class="pricing-header">1 Month</h2>
                        </td>
                        <td>
                            <h2 class="pricing-header">1 Year</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="pricing-features">
                            <span class="pricing-features-item">Join Community</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="pricing-features">
                            <span class="pricing-features-item">Attend events</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="pricing-features">
                            <span class="pricing-features-item">Host free events</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="pricing-features">
                            <span class="pricing-features-item">Host Premium events</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item">-</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"><i class="fas fa-check"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="pricing-features">
                            <span class="pricing-features-item">Prioritized visibility of events</span>

                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"> - </span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item">(Upcoming)</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item">(Upcoming)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="pricing-features">
                            <span class="pricing-features-item">Location - based suggestions</span>

                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"> - </span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item">(Upcoming)</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item">(Upcoming)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="pricing-features">
                            <span class="pricing-features-item">Create your own crew</span>

                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item"> - </span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item">(Upcoming)</span>
                        </td>
                        <td class="pricing-features">
                            <span class="pricing-features-item">(Upcoming)</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><span class="pricing-price">Free</span></td>
                        <td><span class="pricing-price">$9.99</span></td>
                        <td><span class="pricing-price">$99</span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span>(save ~$20)</span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?php
                            if (empty($_SESSION['userId'])) {
                            ?>
                                <a href="index.php?action=signUp" class="pricing-button">Sign up</a>
                            <?php
                            }
                            ?>
                        </td>
                        <td><a href="index.php?action=<?= $month ?>" class="pricing-button is-featured">Go Premium</a></td>
                        <td><a href="index.php?action=<?= $year ?>" class="pricing-button">Go Premium</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>