FROM mailhog/mailhog

ENV MH_FOLDER_LOG="/var/log/docker/mailhog/"
ENV MH_FOLDER_INIT="/var/docker/mailhog/"
ENV MH_FOLDER_INIT_DATA="/docker-entrypoint-initdata.d/"
ENV MH_MAILDIR_PATH="/mailhog/"

USER root

# install package
RUN set -ex
RUN apk update 
RUN apk upgrade
RUN apk add bash
#del list
RUN rm -rf /var/lib/apt/lists/*

RUN mkdir -p ${MH_FOLDER_LOG}
RUN mkdir -p ${MH_FOLDER_INIT}
RUN mkdir -p ${MH_FOLDER_INIT_DATA}
RUN mkdir -p ${MH_MAILDIR_PATH}

COPY importdata.sh ${MH_FOLDER_INIT}
RUN chmod +x ${MH_FOLDER_INIT}/importdata.sh

COPY docker-data-email-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-data-email-entrypoint.sh

RUN chown mailhog ${MH_MAILDIR_PATH}
RUN chgrp mailhog ${MH_MAILDIR_PATH}
RUN chmod 777 ${MH_MAILDIR_PATH}

CMD ["/bin/sh"]

ENTRYPOINT ["docker-data-email-entrypoint.sh", "MailHog"]

EXPOSE 1025 8025
