<?php
$month = !empty($_SESSION['userId']) ? "premium&q=month" : "signUp&goPrem=true&q=month";
$year = !empty($_SESSION['userId']) ? "premium&q=year" : "signUp&goPrem=true&q=year";

?>

<div class="background">
    <div class="container">
        <div class="panel pricing-table">        
            <table>
                <tr>
                    <td><img src="https://s22.postimg.cc/8mv5gn7w1/paper-plane.png" alt="" class="pricing-img"></td>
                    <td><img src="https://s22.postimg.cc/8mv5gn7w1/paper-plane.png" alt="" class="pricing-img"></td>
                    <td><img src="https://s28.postimg.cc/ju5bnc3x9/plane.png" alt="" class="pricing-img"></td>
                    <td><img src="https://s21.postimg.cc/tpm0cge4n/space-ship.png" alt="" class="pricing-img"></td>
                </tr>
                <tr>
                    <td><h2 class="pricing-header">Features</h2></td>
                    <td><h2 class="pricing-header">Free</h2></td>
                    <td><h2 class="pricing-header">1 Month</h2></td>
                    <td><h2 class="pricing-header">1 Year</h2></td>
                </tr>
                <tr>
                    <td class="pricing-features">
                        <span class="pricing-features-item">Access private Event</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                </tr>
                <tr>
                    <td class="pricing-features">
                        <span class="pricing-features-item">Access global Event</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                </tr>
                <tr>
                    <td class="pricing-features">
                        <span class="pricing-features-item">Creation private Event</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                </tr>
                <tr>
                    <td class="pricing-features">
                        <span class="pricing-features-item">Creation global Event</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"> - </span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                    <td class="pricing-features">
                        <span class="pricing-features-item"><i class="fas fa-check"></i><br>(Unlimited)</span>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><span class="pricing-price">Free</span></td>
                    <td><span class="pricing-price">$9.99</span></td>
                    <td><span class="pricing-price">$99</span><br><span>(save ~$20)</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="index.php?action=signUp" class="pricing-button">Sign up</a></td>
                    <td><a href="index.php?action=<?= $month ?>" class="pricing-button is-featured">Go Premium</a></td>
                    <td><a href="index.php?action=<?= $year ?>" class="pricing-button">Go Premium</a></td>
                </tr>
            </table>
        </div>