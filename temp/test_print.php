<?php
	include_once('./_common.php');
		
	$sql2 = " select * from sj_prs_pledge where mb_id = '{$pid}' and pld_flag = '0' and pld_year='{$p_year}' and pld_semi='{$p_semi}' limit 0, 1 ";
	$row2 = sql_fetch($sql2);
	
	if(!$row2['pld_no'])
		alert("잘못된 정보입니다.");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>윤리 준법 정보보호 서약서</title>
    <link href='https://cdn.rawgit.com/openhiun/hangul/14c0f6faa2941116bb53001d6a7dcd5e82300c3f/nanumbarungothic.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/nanummyeongjo.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.1.1/es6-promise.auto.js"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
	<div>
		<input type="button" id="printBtn" value="다운로드"/>
	</div>
	<div class="contract-pop" id="capture">
       <div class="logo"><img src="./images/logo.png" alt=""></div>
        <h1 class="mj">윤리경영 실천 / 준법 서약서</h1>
        <p>
            본인은 (주)엔에스쇼핑 구성원으로서 하림그룹의 글로벌 생산성 1위를 실현하고 삶의 가치창출과
            행복 나눔을 위하여 창의적이고 열정적으로 행동하며, 윤리경영과 준법경영을 최우선 가치로 삼아
            건강한 공동체 실현을 주도하기 위하여 다음의 사항을 준수할 것임을 엄숙히 서약합니다.
        </p>
    <div class="txt_01">
        <h2 class="s_tit">Ⅰ. 윤리에 관한 사항</h2>
        <ul>
            <li>
              1. 회사가 글로벌 리더로 성장하기 위하여 단순함을 추구하고, 윤리적으로 행동하며 끊임없이 도전한다.
            </li>
            <li>
              2. 주주의 권리와 이익을 보호하는 투명하고 효율적인 경영을 실현하여 건전한 이윤창출로 기업가치를 증대시킨다.

            </li>
            <li>
              3. 임직원과는 상호 존중하며 창의적이고 열정적으로 행동하는 혁신문화를 주도한다.
            </li>
            <li>
              4. 고객의 가치창출을 최우선으로 협력업체와는 상호 신뢰와 존중으로 함께 성장한다.
            </li>
            <li>
              5. 환경보호와 자원보존에 적극 참여하여 지속적으로 사회적 책무를 성실히 실천한다.
            </li>
        </ul>
      </div>
      <div class="txt_01" style="padding-top:40px">
          <h2 class="s_tit">Ⅱ. 규정의 준수 및 복무에 관한 사항</h2>
          <ul>
              <li>
                1. 회사의 제 규정 및 법령을 준수하고, 임직원의 정당한 직무 명령을 성실히 수행하며, 회사의 이익에 반하는 권한 남용을 하지 않는다.
              </li>
              <li>
                2. 직무는 공과 사를 엄격히 구분하고, 회사의 이익을 우선하여 성실히 수행하며, 회사의 모든 자산을 직무 이외 목적으로 부정하게 사용하지 않는다.
              </li>
              <li>
                3. 직접 또는 친인척이나 이해관계에 있는 자를 통하여 간접적으로 회사와 거래하기 위하여는 회사에 보고를 하고 사전 동의를 얻어야 한다.
              </li>
              <li>
                4. 근무시간을 엄수하고, 사고를 예방하기 위하여 안전 수칙을 철저히 준수하며, 기타 회사에서 정한 근태 기준을 성실히 준수한다.
              </li>
              <li>
                5. 회사의 이해관계자에 대하여 어떠한 경우에도 성적 희롱, 인격적 모멸, 폭행, 괴롭힘 등 반사회적 행위를 하지 않는다.
              </li>
              <li>
                6. 임직원 상호간에 신뢰와 원활한 의사소통을 바탕으로 조화로운 조직 문화를 만든다.
              </li>
              <li>
                 7. 지위를 이용한 부당한 행위, 회사가 승인하지 않은 직무 수행 또는 영업 활동을 하지 아니하며, 부당한행위, 위법행위, 승인받지 아니한 행위로 인하여 회사에 손해 발생이 예상되어 회사의 요청이 있는 경우 관련 자료를 회사에 제출하거나, 회사가 직접 자료를 확인하는 등 조사에 적극 협조 및 동의한다.
              </li>
			  <li>
                 8. 법령 또는 회사의 제 규정을 위반하여 회사에 손해를 입히거나 입힐 우려가 있는 행위 기타 그에 준하는 사유가 발생하여 긴급하게 사실 확인 및 조사 등의 필요가 있을 경우 회사가 전자적 방법 등을 활용하여 회사가 업무용으로 제공한 컴퓨터, PDA 등 디지털 기기, 회사가 업무용 사용을 위해 비용을 지급하는 핸드폰, 회사 서버에 저장된 사내 메일, 사내 메신저 등에 대하여 분석하거나, 조사할 수 있음에 동의한다.
              </li>
			   <li>
                 9. 업무를 수행하면서 다른 임직원의 법령 위반 행위, 회사의 제규정 위반행위, 부당한 행위, 회사에  손해의 발생이 우려되거나, 손해가 발생된 행위에 대하여 하림그룹 헬프라인 (익명제보시스템 -https://www.kbei.org/whistle/center/02/s_1.php)에 즉시 제보하여 윤리경영 및 준법경영 환경이 유지될 수 있도록 조치한다. 
              </li>
          </ul>
        </div>
		        <div class="txt_01" style="padding-top:40px">
            <h2 class="s_tit">Ⅲ. 공정거래에 관한 사항</h2>
            <ul>
                <li style="padding-bottom:10px">
                  1. 공정한 거래가 회사의 경쟁력임을 확인하고 공정거래법 등 관련법령 및 회사 정책에 위반되지 않도록 행동한다.
                  </li>
                <li>
                   2. 공정한 거래를 위하여 하림의 협력사에게 거래상 지위를 남용한 불공정한 거래행위를 하지 않으며, 폭언이나 강압적인 언행을 사용하지 않는다.
                  </li>
                <li>
                  3.  경쟁업체들에게 회사 제품의 판매 내지 공급가격, 생산량, 원가, 거래량(출고량, 재고량 포함), 결제조건 등의 정보를 제공하지 아니하고, 경쟁업체들로부터 관련 정보를 제공받지 아니하며, 임직원들에게 경쟁업체들의 정보를 요청하지 않는다.
                </li>
                <li>
                   4. 불필요한 오해를 불러 일으키지 않도록 경쟁사들과 일체의 접촉을 하지 아니하며, 업무상 필요한 공식적인 모임에 참여해야 하는 경우 “경쟁사 및 협회 모임 활동 금지 행동강령”을 준수한다.
				</li>
                <li>
                   5. 공정거래를 저해하는 행위에 대하여 적극적인 참여, 묵시적인 동의, 타인을 돕는 행위 등의 행위를 하지 않으며, 공정거래 위반 행위를 하거나 위반될 소지가 있을 경우 즉시 준법지원인 또는 회사에 제보한 후 회사의 조치에 적극 협조한다.
				   
                </li>
             </ul>
          </div>
         <div class="txt_01" style="padding-top:40px">
            <h2 class="s_tit">Ⅳ. 정보 보호 및 비밀 유지에 관한 사항</h2>
            <ul>
                <li style="padding-bottom:10px">
                   1. 비밀 정보는 회사의 외부에 공개되지 아니하고, 직무 수행 과정에서 알게 된 다음 각호와 같은 생산, 영업 등 기술상 또는 경영상의 모든 정보(정보저장매체 등에 저장된 디지털 정보 포함)를 의미함을 정확히 이해하고 숙지한다.
                </li>
                <div class="txt_02">
                  <ul>
                  <li>① 제품의 생산방법 등 기술정보에 관한 사항</li>
                  <li>② 상품의 판매방법 등 영업정보에 관한 사항</li>
                  <li>③ 인사, 조직, 재무, 전산 등 관리정보에 관한 사항</li>
                  <li>④ 연구, 개발, 교육, 훈련 등 개발정보에 관한 사항</li>
                  <li>⑤ 타 사업자와의 계약, 제휴 등 협력정보에 관한 사항</li>
                  <li>⑥ 사업계획, 연구계획, 개발계획 등 각종 기획정보에 관한 사항</li>
                  <li>⑦ 관계회사와의 사업정보에 관한 사항</li>
                  <li style="padding-bottom:0px !important">⑧ 위에 열거된 정보 이외에 직무 수행 과정에서 취득, 생성 등 알게 된 모든 정보 및 디지털형식으로 전환된 형태</li>
                </ul>
                </div>
                <li>
                   2. 회사의 비밀정보를 재직 기간 및 퇴직 후에도 회사의 사전 승인 없이 접근권한이 없는 임직원 또는 제3자에게 공개하거나 누설하지 아니하며, 본인 또는 제3자의 이익을 위하여 누설, 사용하지 않는다.
                </li>
                <li>
                   3. 비밀정보가 저장된 문서, 이동식 저장장치, 업무 수행에 필요한 외부 저장매체, 클라우드 앱, 공유 드라이브 등 유무형의 모든 정보저장매체(이하 ‘비밀정보매체’라 함)를 변조, 복사, 훼손, 분실 등 부정하게 사용하지 않으며, 회사의 사전 승인 없이 근무지 외의 장소에서 사용하지 않는다.
                </li>
                <li>
                   4. 접근권한이 없는 정보와 장소에 접근하지 않고, 회사의 사전 승인 없는 소프트웨어 또는 정보저장매체를 사용하지 않으며, 외부 저장매체, 클라우드 앱, 공유 드라이브의 정보에 대하여 목적 달성시 적법한 폐기, 삭제, 내부 시스템으로의 정보 이관 등의 업무를 수행한다. 
                </li>
                <li>
                   5. 회사의 정보보호 정책 및 지침을 성실하게 준수하며, 회사의 사전 통제 절차에 따라 비밀정보를 외부에 발신하고, 회사 통신망을 이용하여 수발신되는 이메일 및 통신 내용은 비밀정보에 해당하여 회사가 정보 보호를 위하여 열람함에 동의한다.
                </li>
                <li>
                   6. 회사 이외 제3자에 대한 비밀정보를 위법하게 취득 또는 보유하고 있지 아니하며, 그 비밀정보를 적법한 권리자의 승인 없이 회사에 공개하거나 직무 수행을 위하여 부정하게 사용하지 않는다.
                </li>
                <li>
                   7. 회사를 퇴직하는 경우에는 보관하고 있는 비밀정보 또는 비밀정보매체를 회사에 즉시 반납하고, 이에 대한 어떠한 형태의 사본도 보관하지 않는다.
                </li>
            </ul>
          </div>
		           <div class="txt_01" style="padding-top:40px">
              <h2 class="s_tit">Ⅴ. 개인정보 보호에 관한 사항</h2>
              <ul>
                  <li>
                     1. 회사의 개인정보 보호 방침을 준수하며, 직무 수행상 알게 된 개인정보를 누설, 유출, 오용하지 않는다.
                  </li>
                  <li>
                     2. 개인정보는 목적에 필요한 최소한의 범위에서 적법하게 수집, 이용, 보관, 제공 등 처리를 하고, 그 목적 외의 용도로 처리하지 않는다.
                   </li>
                  <li>
                     3. 개인정보 주체의 사생활을 현저히 침해할 우려가 있는 건강, 사상, 신념, 정치적 견해 등 민감정보는 불법하게 처리하지 않는다.
                  </li>
                  <li>
                     4. 개인정보가 침해되지 않도록 안전하게 관리하며, 오남용 또는 불법 처리를 알게 된 경우에는 회사의 관리자에게 즉시 보고한다.
                  </li>
              </ul>
            </div>
            <div class="txt_01" style="padding-top:40px">
                <h2 class="s_tit">Ⅵ. 경업 및 겸직 금지에 관한 사항</h2>
                <ul>
                    <li>
                       1. 재직 기간 및 퇴직 후 1년(단, R&D, 연구직 및 마케팅의 경우 2년)동안 회사의 사전 서면동의 없이 본인 또는 제3자의 이익을 위해 국내외를 불문하고 회사의 비밀정보를 이용하여 사업을 영위하거나 경쟁 및 동종 회사를 위해 업무를 수행하지 않는다.
                    </li>
                    <li>2. 재직 기간 동안 회사의 사전 승인없이 다른 회사의 임직원, 고문, 기타 사용인의 직무를 겸하지 않는다.
                    </li>
                </ul>
              </div>
              <div class="txt_01" style="padding-top:40px">
                  <h2 class="s_tit">Ⅶ. 청렴 의무에 관한 사항</h2>
                  <ul>
                      <li>
                        1. 공정하고 투명하게 직무를 수행하며, 임직원, 협력회사, 고객 등 이해관계자들로부터 사회 통념상 인정되지 아니하는 금품, 향응, 접대 또는 기타 개인적인 편의 등을 제공하거나 제공받지 않는다.
                      </li>
                      <li>
                        2. 회사의 경비는 직무 수행을 위해서만 적법하게 사용하고, 회사의 이해관계자와 어떠한 경우에도 금전대차, 대출보증, 임대차 등 금전거래를 하지 않는다.
                      </li>
                      <li style="margin-bottom:0px !important;">
                        3. 협력업체와 진행하는 공사, 용역, 구매 등 모든 계약의 이행에 있어서 관계법령에 따라 공정하고 투명하게 직무를 수행하고, 거래상의 지위를 이용하여 사회통념에 벗어난 찬조 등 불공정하고 부당한 요구를 하지 않는다.
                      </li>
                  </ul>
                </div>
              <div class="last_txt">
                <p>본인은 본 서약을 위반하였을 경우 관련법령에 의한 민형사상의 책임을 지며, 회사의 사규 등 내부 규정에
                  따른 징계조치 등 어떠한 불이익도 감수할 것이고, 그로 인한 회사의 손해를 지체 없이 배상함을 서약합니다.</p>
              </div>
		<div class="form">
			<div class="date">
				<span id="year" ><?php echo $row2['pld_year']?></span> 년
				<span id="month"><?php echo $row2['pld_month']?></span> 월
				<span id="date" ><?php echo $row2['pld_day']?></span> 일 
			</div>
			<div class="name">
				사번: <span id="pid" ><?php echo $row2['pld_enb']?></span>
				<span></span>
				이름: <span id="pname" ><?php echo $row2['pld_name']?></span>
			</div>
			<div class="btnbox">
			</div>
		</div>
	</div>
	<script>
		var fileName       = "<?php echo $row2['pld_enb'] ?>";
		var year = new Date().getFullYear();
		var month = new Date().getMonth() + 1;
		var date = new Date().getDate();
		window.onload = function(){
			document.getElementById('year').innerText = year;
			document.getElementById('month').value = month;
			document.getElementById('date').value = date;
		}
		
		$("#printBtn").on("click",function(){
			html2canvas(document.querySelector("#capture")).then(canvas => {
				// base64 url 로 변환
				var imgData = canvas.toDataURL('image/jpeg');

				var imgWidth = 210; // 이미지 가로 길이(mm) A4 기준
				var pageHeight = imgWidth * 1.414; // 출력 페이지 세로 길이 계산 A4 기준
				var imgHeight = canvas.height * imgWidth / canvas.width;
				var heightLeft = imgHeight;
				var margin = 0;

				var doc = new jsPDF('p', 'mm', 'a4');
				var position = 0;

				// 첫 페이지 출력
				doc.addImage(imgData, 'jpeg', margin, position, imgWidth, imgHeight);
				heightLeft -= pageHeight;

				// 한 페이지 이상일 경우 루프 돌면서 출력
				while (heightLeft >= 20) {
					position = heightLeft - imgHeight;
					doc.addPage();
					doc.addImage(imgData, 'jpeg', margin, position, imgWidth, imgHeight);
					heightLeft -= pageHeight;
				}

				// 파일 저장
				doc.save(fileName);
			});
		});
	</script>
    </div>
</body>
</html>