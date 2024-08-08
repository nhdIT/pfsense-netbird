# $FreeBSD$

PORTNAME=		pfSense-pkg-netbird
PORTVERSION=	0.0.2
PORTREVISION=	30
CATEGORIES=		net
MASTER_SITES=	# empty
DISTFILES=		# empty
EXTRACT_ONLY=	# empty

MAINTAINER=		rdeweese@nhdit.com
COMMENT=		pfSense package netbird poorly put together by nhdIT, LLC

LICENSE=		APACHE20

RUN_DEPENDS=	netbird>0:net/netbird \

NO_BUILD=		yes
NO_MTREE=		yes

SUB_FILES=		pkg-install pkg-deinstall
SUB_LIST=		PORTNAME=${PORTNAME}

do-extract:
		${MKDIR} ${WRKSRC}

do-install:
		${MKDIR} ${STAGEDIR}${PREFIX}/pkg
		${MKDIR} ${STAGEDIR}${PREFIX}/www
		${MKDIR} ${STAGEDIR}${DATADIR}
		${INSTALL_DATA} -m 0644 ${FILESDIR}${PREFIX}/pkg/netbird.xml \
				${STAGEDIR}${PREFIX}/pkg
		${INSTALL_DATA} ${FILESDIR}${PREFIX}/pkg/netbird.xml \
				${STAGEDIR}${PREFIX}/pkg
		${INSTALL_DATA} ${FILESDIR}${PREFIX}/pkg/netbird.inc \
				${STAGEDIR}${PREFIX}/pkg
		${INSTALL_DATA} ${FILESDIR}${PREFIX}/www/vpn_netbird.php \
                ${STAGEDIR}${PREFIX}/www
		${INSTALL_DATA} ${FILESDIR}${DATADIR}/info.xml \
			${STAGEDIR}${DATADIR}
		@${REINPLACE_CMD} -i '' -e "s|%%PKGVERSION%%|${PKGVERSION}|" \
				${STAGEDIR}${PREFIX}/pkg/netbird.xml \
				${STAGEDIR}${DATADIR}/info.xml

.include <bsd.port.mk>
