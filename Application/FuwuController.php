add2Action

	if(IS_POST){
			if(!empty($_FILES['avc']['tmp_name'])){
				$tupian = uploadpic($_FILES['avc'],'fuwu');
				$m_shanghufuwu->photo = $tupain;
			}

			if(!empty($_FILES['tupian1']['tmp_name'])){
				$tupian = uploadpic($_FILES['tupian1'],'fuwu').',';
			}else{
				$tupian = ',';
			}

			if(!empty($_FILES['tupian2']['tmp_name'])){
				$tupian = $tupian . uploadpic($_FILES['tupian2'],'fuwu').',';
			}else{
				$tupian = $tupian . ',';
			}
			
			if(!empty($_FILES['tupian3']['tmp_name'])){
				$tupian = $tupian . uploadpic($_FILES['tupian3'],'fuwu');
			}

			$m_shanghufuwu->tupian = $tupian;