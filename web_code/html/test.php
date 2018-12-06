<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="test-style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>


  </head>
  <body>
    <table class="order-list-table">
								<caption>주문내역조회 목록</caption>
								<colgroup>
									<col style="width:172px;">
									<col style="width:auto;">
									<col style="width:101px;">
									<col style="width:101px;">
								</colgroup>
								<thead>
									<tr>
										<th scope="col" class="first">주문일(결제번호)</th>
										<th scope="col">상품명/주문옵션/주문번호</th>
										<th scope="col">판매자</th>
										<th scope="col">주문상태</th>
									</tr>
								</thead>

									<tbody><tr class="sep tr1534079417" id="tr1534079417">
										<td class="date-payment-num" rowspan="3">
											<div class="date-num">
												<strong>2018-11-18</strong>
												(<a href="javascript:InProcessAction.PopupOrderDetail('1534079417');"><span>1154794888</span></a>)

											</div>
											<!-- 결제금액 -->
											<div class="total-charge">
											결제금액: <strong class="charge"><span class="num">9,900</span>원</strong>
											</div>
											<!-- //결제금액 -->
											<!-- 주문상세보기 -->
											<div class="detail-link">
											  <a href="javascript:InProcessAction.PopupOrderDetail('1534079417');" class="link">주문상세보기</a>

											</div>

											<!-- 영수증편의성 725.2015-08-03 버튼추가 //BC_9754_[SA506_215]_옥션 영수증 편의성 개선  -->
											<div class="receipt_print">
											<a href="javascript:jsfn_accountPopupBuyBill('1154794888');"><img alt="구매영수증 출력" src="//pics.auction.co.kr/myauction/button/btn_buy_receipt_print.gif"></a>

											</div>
											<!-- 영수증편의성 725.2015-08-03 버튼추가 //BC_9754_[SA506_215]_옥션 영수증 편의성 개선  -->

											<!-- //주문상세보기 -->
										</td>
										<td class="product">
											<div class="product-block">
												<a href="http://itempage.auction.co.kr/detailview.aspx?ItemNo=A564284718" target="_blank" class="product-thumbnail">
												<img src="http://image.iacstatic.co.kr/itemimage/bf/6a/0b/bf6a0bf00.jpg" style="width :60px; height : 60px" alt="" onerror="if(this.src=='http://pics.auction.co.kr/common/img_error60.gif') return; this.src='http://pics.auction.co.kr/common/img_error60.gif';"></a>
												<!-- 2015.04.07 요청으로 주석처리 SYC 이재경 -->

												<div class="product-content">
													<div class="product-name">
														<a href="http://itempage.auction.co.kr/detailview.aspx?ItemNo=A564284718" target="_blank">
														올레농원 고당도 감귤 10KG 싱싱함이 그대로~ 농가직송</a>
													</div>
													<ul class="product-order-option"><li>제주감귤 / 제주감귤 10kg 중대과(주말할인이벤트★) / 9,900원 / 1개 </li></ul>

													<div class="product-order-num">
														<span class="label">주문번호</span> 1534079417
													</div>

							            <div class="product-order-delivery" style="display:none;">
								            <span class="label">배송지</span> 권도경, 서울특별시 동작구...
							            </div>

												</div>
											</div>
										</td>
										<td class="seller">
											<span class="seller-info-toggle">
											<span style="cursor:hand" onmouseover="javascript:Events.MemberInfoWithLayerMenu_Seller(this,'1534079417','akdnstjr','올레농원','1534079417','','','','','');">올레농원<img src="http://pics.auction.co.kr/myauction/button/btn_barrow02.gif"></span>
											<!-- 해외배송 아이콘 추가 yeol-->

											<!-- //해외배송 아이콘 추가 yeol-->
										</span></td>
										<td class="status">
											<strong class="status-msg">배송완료</strong>
											<span>11-29결정<br></span>
											<a href="javascript:javascript:InProcessAction.TraceItemPopup('1534079417', '1249095814')"><img src="http://pics.auction.co.kr/myauction/2011/btn_check_ship.gif" alt="배송조회"></a>


										</td>
									</tr>

									<tr>
										<td class="actions" colspan="3">

											<div class="links">

											<!-- 영수증편의성 725.2015-08-03 버튼추가 //BC_9754_[SA506_215]_옥션 영수증 편의성 개선  -->
											<a onclick="openReceipt(1534079417);return false;" class="link" style="cursor:pointer;">신용카드영수증 출력</a>
											<!-- 영수증편의성 725.2015-08-03 버튼추가 //BC_9754_[SA506_215]_옥션 영수증 편의성 개선  -->
											<a href="javascript:InProcessAction.OpenSendNotePopup('1534079417');" class="link">판매자에게 문의하기</a>

											</div>
											<div class="buttons">
												<a href="javascript:InProcessAction.AutoConfirmExceptionPopup('1534079417')" class="button" id="ldNotReceived1534079417"><span>미수령</span></a>
<a href="javascript:InProcessAction.GoReturnRequest('1534079417')" class="button" id="ldReturnRequest1534079417"><span>반품신청</span></a>
<a href="javascript:InProcessAction.GoExchangeRequest('1534079417')" class="button" id="ldExchangeRequest1534079417"><span>교환신청</span></a>
<a href="javascript:InProcessAction.PopupOnBuyingDecision('A564284718','1534079417')" class="button button-strong" id="ldOrderDecision1534079417"><span>상품평 | 구매결정</span></a>

											</div>
										</td>
									</tr>

									<!-- Smile Box -->
									<tr><td class="smilebox" colspan="3" style="display:none"></td></tr>



						</tbody><tbody id="asynchtml" style="display:none;">
						</tbody>
					</table>
  </body>
</html>
